<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogPostBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPostBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPostBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPostBlock[]    findAll()
 * @method BlogPostBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPostBlock::class);
    }

    // /**
    //  * @return BlogPostBlock[] Returns an array of BlogPostBlock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogPostBlock
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
