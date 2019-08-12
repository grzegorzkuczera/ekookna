<?php

namespace App\Repository;

use App\Entity\PlainPassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlainPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlainPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlainPassword[]    findAll()
 * @method PlainPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlainPasswordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlainPassword::class);
    }

    // /**
    //  * @return PlainPassword[] Returns an array of PlainPassword objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlainPassword
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
