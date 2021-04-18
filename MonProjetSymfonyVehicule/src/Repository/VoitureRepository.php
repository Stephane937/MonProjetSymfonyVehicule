<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function searchCar($criteria)
    {
        return $this->createQueryBuilder('m')
            ->where('m.moteur = :moteurName')
            ->setParameter('moteurName', $criteria['moteur'])
            ->andWhere('m.places = :places')
            ->setParameter('places', $criteria['places'])
            ->andWhere('m.prix > :prixMinimum')
            ->setParameter('prixMinimum', $criteria['prixMinimum'])
            ->andWhere('m.prix < :prixMaximum')
            ->setParameter('prixMaximum', $criteria['prixMaximum'])
            ->getQuery()
            ->getResult()
        ;
    }

    public function searchcar2($criteria)
    {
        return $this->createQueryBuilder('m')
            ->where('m.marque like :marque')
            ->setParameter('marque', $criteria['marque']."%")
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Voiture
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
