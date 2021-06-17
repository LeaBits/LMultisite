<?php

namespace App\Repository\Base;

use App\Entity\Base\NavigationPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NavigationPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method NavigationPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method NavigationPage[]    findAll()
 * @method NavigationPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavigationPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NavigationPage::class);
    }
}
