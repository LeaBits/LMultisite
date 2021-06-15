<?php

namespace App\Repository\Base;

use App\Entity\Base\Navigation;
use App\Entity\Base\Page;
use App\Entity\Base\Site;
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
     * @return int|mixed|string
     */
    public function findBySite(Site $site)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.site = :val')
            ->andWhere('a.isPublished = true')
            ->setParameter('val', $site->getId())
            ->orderBy('a.title', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Navigation $navigation
     * @return int|mixed|string
     */
    public function findByNavigation(Navigation $navigation)
    {
        return $this->createQueryBuilder('a, np, n')
            ->innerJoin('a.navigationPages', 'np')
            ->innerJoin('np.navigation', 'n')
            ->andWhere('n.id = :val')
            ->andWhere('a.isPublished = true')
            ->setParameter('val', $navigation->getId())
            ->orderBy('a.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
