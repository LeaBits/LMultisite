<?php

namespace App\Repository\Base;

use App\Entity\Base\BlogPost;
use App\Entity\Base\BlogPostBlock;
use App\Exception\Base\MisplacedException;
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
     * @return array
     * @throws MisplacedException
     */
    public function findByBlogPost(BlogPost $blogPost): array
    {
        $data = $this->createQueryBuilder('a')
            ->andWhere('a.blogPost = :val')
            ->setParameter('val', $blogPost->getId())
            ->orderBy('a.title', 'ASC')
            ->getQuery()
            ->getArrayResult();
        if(!is_array($data) || count($data) == 0){
            throw new MisplacedException('Missing blog post blocks');
        }
        return $data;
    }
}
