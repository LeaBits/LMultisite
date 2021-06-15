<?php

namespace App\Repository\Base;

use App\Entity\Base\Page;
use App\Entity\Base\PageBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageBlock[]    findAll()
 * @method PageBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageBlock::class);
    }

    /**
     * @param Page $page
     * @return int|mixed|string
     */
    public function findByPage(Page $page)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.site = :val')
            ->andWhere('a.isPublished = true')
            ->setParameter('val', $page->getId())
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
