<?php

namespace App\Repository;

use App\Entity\Utilitaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Utilitaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilitaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilitaires[]    findAll()
 * @method Utilitaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilitairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilitaires::class);
    }

    public function searchUtilitaires($criteria)
    {
        return $this->createQueryBuilder('m')
            ->where('m.prixU > :prixMinimum')
            ->setParameter('prixMinimum', $criteria['prixMinimum'])
            ->andWhere('m.prixU < :prixMaximum')
            ->setParameter('prixMaximum', $criteria['prixMaximum'])
            ->getQuery()
            ->getResult()
            ;
    }

    public function searchUtilitaires2($criteria)
    {
        return $this->createQueryBuilder('m')
            ->where('m.marqueU like :marqueU')
            ->setParameter('marqueU', $criteria['marqueU']."%")
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Utilitaires
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
