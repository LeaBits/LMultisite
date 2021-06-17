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
}
