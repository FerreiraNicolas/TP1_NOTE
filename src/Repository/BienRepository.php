<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    // /**
    //  * @return Bien[] Returns an array of Bien objects
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
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function getUnBien($id)
{

$qb = $this->_em->createQueryBuilder();
$qb->select('a')
->from(Bien::class,
'a')
->where('a.id = :id')
->setParameter('id'

, $id);
$query = $qb->getQuery();
$result = $query->getOneOrNullResult();
return $result;
}



    public function findAllBiens()
{ // Création du QueryBuilder

$queryBuilder = $this->_em->createQueryBuilder()

->select('v')
->from (Bien::class, 'v') ;

// récupérer la requête
$query = $queryBuilder->getQuery() ;
// Les résultats
$resultats = $query->getResult() ;

}


public function rechercherParType($type) {

$queryBuilder = $this->_em->createQueryBuilder('v') ;
$queryBuilder

->select('v')
    ->from(Bien::class,'v')
    ->innerJoin(\App\Entity\Type::class,'c','WITH','c.id = v.id_type')
    ->where('c.id= :id')
    ->setParameter('id',$type);
$query= $queryBuilder->getQuery();
$result= $query->getResult();

    
return $result;

}

}