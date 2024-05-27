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

    public function getScore($experienceID)
    {
        return $this->createQueryBuilder('e')
            ->select('
                SUM(CASE WHEN e.q1 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q2 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q3 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q4 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q5 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q6 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q7 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q8 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q9 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q10 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q11= true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q12 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q13 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q14 = true THEN 1 ELSE 0 END) + 
                SUM(CASE WHEN e.q15 = true THEN 1 ELSE 0 END) as checkedCount
            ')
            ->leftJoin('e.image', 'i')
            ->leftJoin('i.membre', 'm')
            ->leftJoin('m.activite', 'a')
            ->where('a.experience = :id')
            ->setParameter('id', $experienceID)
            ->getQuery()->getSingleScalarResult();
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
