<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogPost;
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

    /**
     * @param BlogPost $blogPost
     * @return int|mixed|string
     */
    public function findByBlogPost(BlogPost $blogPost)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.blogPost = :val')
            ->setParameter('val', $blogPost->getId())
            ->orderBy('a.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
