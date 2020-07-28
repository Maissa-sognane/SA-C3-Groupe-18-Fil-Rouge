<?php

namespace App\Repository;

use App\Entity\GroupeCompetance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeCompetance|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeCompetance|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeCompetance[]    findAll()
 * @method GroupeCompetance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeCompetanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeCompetance::class);
    }

    // /**
    //  * @return GroupeCompetance[] Returns an array of GroupeCompetance objects
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
    public function findOneBySomeField($value): ?GroupeCompetance
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
