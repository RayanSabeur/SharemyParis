<?php

namespace App\Repository;

use App\Entity\Activites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Migrations\Query\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;


/**
 * @method Activites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activites[]    findAll()
 * @method Activites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activites::class);
    } 


    public function findAllArray($query)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.titre', 'asc')
            ->where('a.titre LIKE :query')
            ->setParameter('query', '%' . $query . '%');
        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        // return $qb->getQuery()->getArrayResult(); // Hydratation array, équivalent à la ligne du dessus
    }
    
    public function findAllArrayUser($query, $publicAccess)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.titre', 'asc')
            ->join('a.User', 'u')
            ->addSelect('u')
            ->where('a.titre LIKE :query')   
            ->setParameter('query', '%' . $query . '%');
        
        if (isset($publicAccess)){
          $qb->andWhere('a.public = :publicAccess')
            ->setParameter('publicAccess', "")       
            ->setParameter('publicAccess', "groupe");        
            
        }
        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        // return $qb->getQuery()->getArrayResult(); // Hydratation array, équivalent à la ligne du dessus
    }

    public function findAllArrayUser2()
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.titre', 'asc')
            ->join('a.User', 'u')
            ->addSelect('u');
        
     
        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        // return $qb->getQuery()->getArrayResult(); // Hydratation array, équivalent à la ligne du dessus
    }
    
    

    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
