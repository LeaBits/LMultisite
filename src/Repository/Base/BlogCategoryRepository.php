<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogCategory;
use App\Entity\Base\Site;
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
}
