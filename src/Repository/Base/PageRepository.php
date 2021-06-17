<?php

namespace App\Repository\Base;

use App\Entity\Base\Navigation;
use App\Entity\Base\Page;
use App\Entity\Base\Site;
use App\Exception\Base\MisplacedException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    /**
     * @param Site $site
     * @return array
     * @throws MisplacedException
     */
    public function findBySite(Site $site): array
    {
        $data = $this->createQueryBuilder('a')
            ->andWhere('a.site = :val')
            ->andWhere('a.isPublished = true')
            ->setParameter('val', $site->getId())
            ->orderBy('a.title', 'ASC')
            ->getQuery()
            ->getArrayResult();
        if(!is_array($data) || count($data) == 0){
            throw new MisplacedException('Missing page');
        }
        return $data;
    }

    /**
     * @param Navigation $navigation
     * @return array
     * @throws MisplacedException
     */
    public function findByNavigation(Navigation $navigation): array
    {
        $data = $this->createQueryBuilder('a, np, n')
            ->innerJoin('a.navigationPages', 'np')
            ->innerJoin('np.navigation', 'n')
            ->andWhere('n.id = :val')
            ->andWhere('a.isPublished = true')
            ->setParameter('val', $navigation->getId())
            ->orderBy('a.title', 'ASC')
            ->getQuery()
            ->getArrayResult();
        if(!is_array($data) || count($data) == 0){
            throw new MisplacedException('Missing page');
        }
        return $data;
    }

    /**
     * @param string $path
     * @param Site $site
     * @return Page
     * @throws MisplacedException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByPath(string $path = "", Site $site): Page
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.site = :site')
            ->andWhere('a.isPublished = true');
        // empty path, maybe home?
        if($path == ""){
            $query->andWhere('a.isHome = true');
        }else{
            $query->andWhere('a.slug = :val')
                ->setParameter('val', $path);
        }
        $data = $query->setParameter('site', $site->getId())
            ->getQuery()
            ->getOneOrNullResult();
        if($data == null){
            throw new MisplacedException('Missing page');
        }
        return $data;
    }
}
