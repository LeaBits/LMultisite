<?php

namespace App\Repository\Base;

use App\Entity\Base\Template;
use App\Entity\Base\TemplateBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TemplateBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemplateBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemplateBlock[]    findAll()
 * @method TemplateBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemplateBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TemplateBlock::class);
    }

    /**
     * @param Template $template
     * @return int|mixed|string
     */
    public function findByTemplate(Template $template)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.template = :val')
            ->setParameter('val', $template->getId())
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
