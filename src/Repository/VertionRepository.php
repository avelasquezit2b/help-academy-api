<?php

namespace App\Repository;

use App\Entity\Vertion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vertion>
 *
 * @method Vertion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vertion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vertion[]    findAll()
 * @method Vertion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VertionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vertion::class);
    }

//    /**
//     * @return Vertion[] Returns an array of Vertion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vertion
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
