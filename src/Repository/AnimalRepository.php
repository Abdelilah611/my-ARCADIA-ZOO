<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\FoodConsumption;
use App\Entity\VeterinaryReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 *
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * @return Animal[] Returns an array of Animal objects
     */
    public function spotlighted(): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.name IN (:names)')
            ->setParameter('names', ['Leonidas', 'Indira', 'Aria'])
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByLastFoodConsumptionForAnimal(Animal $animal): ?FoodConsumption
    {
        return $this->getEntityManager()
            ->getRepository(FoodConsumption::class)
            ->createQueryBuilder('fc')
            ->where('fc.animal = :animal')
            ->setParameter('animal', $animal)
            ->orderBy('fc.date', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByLastVetReportForAnimal(Animal $animal): ?VeterinaryReport
    {
        return $this->getEntityManager()
            ->getRepository(VeterinaryReport::class)
            ->createQueryBuilder('vr')
            ->where('vr.animal = :animal')
            ->setParameter('animal', $animal)
            ->orderBy('vr.date', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
