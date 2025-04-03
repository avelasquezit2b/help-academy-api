<?php

namespace App\Repository;

use App\Entity\RoadmapItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoadmapItem>
 *
 * @method RoadmapItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoadmapItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoadmapItem[]    findAll()
 * @method RoadmapItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoadmapItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoadmapItem::class);
    }

//    /**
//     * @return RoadmapItem[] Returns an array of RoadmapItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RoadmapItem
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
