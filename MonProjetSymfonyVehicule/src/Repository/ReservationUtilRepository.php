<?php

namespace App\Repository;

use App\Entity\ReservationUtil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationUtil|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationUtil|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationUtil[]    findAll()
 * @method ReservationUtil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationUtilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationUtil::class);
    }

    // /**
    //  * @return ReservationUtil[] Returns an array of ReservationUtil objects
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
    public function findOneBySomeField($value): ?ReservationUtil
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
