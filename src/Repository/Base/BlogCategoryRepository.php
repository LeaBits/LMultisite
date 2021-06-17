<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogCategory;
use App\Entity\Base\Site;
use App\Exception\Base\MisplacedException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogCategory[]    findAll()
 * @method BlogCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogCategory::class);
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
            throw new MisplacedException('Missing blog category');
        }
        return $data;
    }

    /**
     * @param string $path
     * @param Site $site
     * @return BlogCategory
     * @throws MisplacedException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByPath(string $path, Site $site): BlogCategory
    {
        $data = $this->createQueryBuilder('a')
            ->andWhere('a.site = :site')
            ->andWhere('a.slug = :val')
            ->andWhere('a.isPublished = true')
            ->setParameter('site', $site->getId())
            ->setParameter('val', $path)
            ->getQuery()
            ->getOneOrNullResult();
        if($data == null){
            throw new MisplacedException('Missing blog category');
        }
        return $data;
    }
}
