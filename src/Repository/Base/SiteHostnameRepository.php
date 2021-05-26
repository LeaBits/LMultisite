<?php

namespace App\Repository\Base;

use App\Entity\Base\SiteHostname;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SiteHostname|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteHostname|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteHostname[]    findAll()
 * @method SiteHostname[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteHostnameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteHostname::class);
    }

    // /**
    //  * @return SiteHostname[] Returns an array of SiteHostname objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SiteHostname
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
