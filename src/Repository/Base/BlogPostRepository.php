<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogPost;
use App\Entity\Base\Site;
use App\Exception\Base\MisplacedException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
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
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getArrayResult();
        if(!is_array($data) || count($data) == 0){
            throw new MisplacedException('Missing blog posts');
        }
        return $data;
    }

    /**
     * @param string $path
     * @param Site $site
     * @return BlogPost
     * @throws MisplacedException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByPath(string $path, Site $site): BlogPost
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
            throw new MisplacedException('Missing blog post');
        }
        return $data;
    }
}
