<?php

namespace App\Repository\Base;

use App\Entity\Base\Site;
use App\Exception\Base\MisplacedException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Site|null find($id, $lockMode = null, $lockVersion = null)
 * @method Site|null findOneBy(array $criteria, array $orderBy = null)
 * @method Site[]    findAll()
 * @method Site[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Site::class);
    }

    /**
     * @param string $hostname
     * @return Site
     * @throws MisplacedException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByHostname(string $hostname): Site
    {
        $entityManager = $this->getEntityManager();
        $data = $entityManager->createQuery(
            'SELECT s, h
            FROM App\Entity\Base\Site s
            INNER JOIN s.siteHostnames h
            WHERE h.url = :value
            AND s.isPublished = true
            AND h.isPublished = true'
        )
            ->setParameter('value', $hostname)
            ->getOneOrNullResult();
        if($data == null){
            throw new MisplacedException('Missing site');
        }
        return $data;
    }
}
