<?php

namespace App\Repository;

use App\Entity\Month;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Month>
 *
 * @method Month|null find($id, $lockMode = null, $lockVersion = null)
 * @method Month|null findOneBy(array $criteria, array $orderBy = null)
 * @method Month[]    findAll()
 * @method Month[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Month::class);
    }

        /**
    * Récupère le nom du mois correspondant au numéro donné.
    *
    * @param int $month_number Le numéro du mois à rechercher.
    *
    * @return string|null Le nom du mois correspondant, ou null s'il n'existe pas.
    */
    public function getMonthNameFromDb(int $month_number): ?string
    {
        // Recherche le mois correspondant au numéro passé en paramètre
        $month_match = $this->find($month_number);
        // Récupère le nom du mois correspondant au numéro passé en paramètre s'il existe, sinon null
        return $month_match ? $month_match->getNameMonth() : null;
    }


    //    /**
    //     * @return Month[] Returns an array of Month objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Month
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


}
