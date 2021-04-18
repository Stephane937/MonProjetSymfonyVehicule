<?php

namespace App\Repository;

use App\Entity\CampingCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CampingCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampingCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampingCar[]    findAll()
 * @method CampingCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampingCarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampingCar::class);
    }

    public function searchCampingCar($criteria)
    {
        return $this->createQueryBuilder('m')
            ->where('m.prix > :prixMinimum')
            ->setParameter('prixMinimum', $criteria['prixMinimum'])
            ->andWhere('m.prix < :prixMaximum')
            ->setParameter('prixMaximum', $criteria['prixMaximum'])
            ->getQuery()
            ->getResult()
            ;
    }

    public function searchCampingCar2($criteria)
    {
        return $this->createQueryBuilder('m')
            ->where('m.marque like :marque')
            ->setParameter('marque', $criteria['marque']."%")
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?CampingCar
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
