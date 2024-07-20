<?php

namespace App\Repository;

use App\Entity\FoodConsumption;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FoodConsumption>
 *
 * @method FoodConsumption|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodConsumption|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodConsumption[]    findAll()
 * @method FoodConsumption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodConsumptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodConsumption::class);
    }

    /**
     * @return FoodConsumption[]
     */
    public function findLastSixByEmployee(User $employee): array
    {
        $query = $this->createQueryBuilder('fc')
            ->where('fc.employee = :employee')
            ->setParameter('employee', $employee)
            ->orderBy('fc.date', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();

        return $query;
    }
}
