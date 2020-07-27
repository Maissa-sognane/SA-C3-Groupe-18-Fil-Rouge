<?php

namespace App\Repository;

use App\Entity\GroupeUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeUser[]    findAll()
 * @method GroupeUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeUser::class);
    }

    // /**
    //  * @return GroupeUser[] Returns an array of GroupeUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeUser
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
