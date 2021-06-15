<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogTag[]    findAll()
 * @method BlogTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogTag::class);
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
