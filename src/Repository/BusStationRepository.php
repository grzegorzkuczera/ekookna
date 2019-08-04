<?php

namespace App\Repository;

use App\Entity\BusStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BusStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BusStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BusStation[]    findAll()
 * @method BusStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BusStationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BusStation::class);
    }

    // /**
    //  * @return BusStation[] Returns an array of BusStation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BusStation
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
