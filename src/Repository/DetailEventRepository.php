<?php

namespace App\Repository;

use App\Entity\DetailEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailEvent>
 *
 * @method DetailEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailEvent[]    findAll()
 * @method DetailEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailEvent::class);
    }

    //    /**
    //     * @return DetailEvent[] Returns an array of DetailEvent objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DetailEvent
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
