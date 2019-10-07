<?php

namespace App\Repository;

use App\Entity\Press;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Press|null find($id, $lockMode = null, $lockVersion = null)
 * @method Press|null findOneBy(array $criteria, array $orderBy = null)
 * @method Press[]    findAll()
 * @method Press[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PressRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Press::class);
    }

    // /**
    //  * @return Press[] Returns an array of Press objects
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
    public function findOneBySomeField($value): ?Press
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
