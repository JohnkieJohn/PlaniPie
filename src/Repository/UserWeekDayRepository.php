<?php

namespace App\Repository;

use App\Entity\UserWeekDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserWeekDay>
 *
 * @method UserWeekDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWeekDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWeekDay[]    findAll()
 * @method UserWeekDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWeekDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWeekDay::class);
    }

    //    /**
    //     * @return UserWeekDay[] Returns an array of UserWeekDay objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserWeekDay
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
