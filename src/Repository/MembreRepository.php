<?php

namespace App\Repository;

use App\Entity\Membre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Membre>
 */
class MembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Membre::class);
    }

    public function getOneByExperience($experienceId)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.activite', 'a')
            ->leftJoin('a.experience', 'e')
            ->where('e.id = :experience')
            ->setParameter('experience', $experienceId)
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
            ->leftJoin('e.activite', 'a')
            ->where('a.experience = :id')
            ->setParameter('id', $experienceID)
            ->getQuery()->getSingleScalarResult();
    }

    //    /**
    //     * @return Membre[] Returns an array of Membre objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Membre
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
