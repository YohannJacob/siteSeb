<?php

namespace App\Repository;

use App\Entity\MakingOf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MakingOf|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakingOf|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakingOf[]    findAll()
 * @method MakingOf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakingOfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MakingOf::class);
    }

    // /**
    //  * @return MakingOf[] Returns an array of MakingOf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MakingOf
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
