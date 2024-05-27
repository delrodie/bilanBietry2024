<?php

namespace App\Repository;

use App\Entity\Fonctionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fonctionnement>
 */
class FonctionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fonctionnement::class);
    }

    public function getOneByExperience($experienceID)
    {
        return $this->createQueryBuilder('f')
            ->leftJoin('f.image', 'i')
            ->leftJoin('i.membre', 'm')
            ->leftJoin('m.activite', 'a')
            ->leftJoin('a.experience', 'e')
            ->where('e.id = :experience')
            ->setParameter('experience', $experienceID)
            ->getQuery()->getOneOrNullResult();
    }

    //    /**
    //     * @return Fonctionnement[] Returns an array of Fonctionnement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Fonctionnement
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
