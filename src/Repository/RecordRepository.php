<?php

namespace App\Repository;

use App\Entity\Employee;
use App\Entity\Record;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Record>
 *
 * @method Record|null find($id, $lockMode = null, $lockVersion = null)
 * @method Record|null findOneBy(array $criteria, array $orderBy = null)
 * @method Record[]    findAll()
 * @method Record[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Record::class);
    }

    public function save(Record $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Record $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByDatesAndEmployee(DateTime $startDate, DateTime $endDate, Employee $employee){
        return $this->createQueryBuilder('r')
            ->innerJoin('r.employee', 'e', 'WITH', 'e.id = :employee_id')
            ->where('r.date BETWEEN :startDate AND :endDate')            
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->setParameter('employee_id', $employee->getId())
            ->getQuery()
            ->getResult();
    }

    public function totalDeliveriesByDatesAndEmployee(DateTime $startDate, DateTime $endDate, Employee $employee){
        return $this->createQueryBuilder('r')
            ->select("sum(r.quantity) as totalDeliveries")
            ->innerJoin('r.employee', 'e', 'WITH', 'e.id = :employee_id')
            ->where('r.date BETWEEN :startDate AND :endDate')            
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->setParameter('employee_id', $employee->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }

//    /**
//     * @return Record[] Returns an array of Record objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Record
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
