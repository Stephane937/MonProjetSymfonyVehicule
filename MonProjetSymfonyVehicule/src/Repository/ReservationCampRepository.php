<?php

namespace App\Repository;

use App\Entity\ReservationCamp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationCamp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationCamp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationCamp[]    findAll()
 * @method ReservationCamp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationCampRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationCamp::class);
    }

    // /**
    //  * @return ReservationCamp[] Returns an array of ReservationCamp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationCamp
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
