<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Habitat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Habitat>
 *
 * @method Habitat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Habitat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Habitat[]    findAll()
 * @method Habitat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HabitatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Habitat::class);
    }

    /**
     * @return Habitat[] Returns an array of Habitat objects
     */
    public function allHabitats(): array
    {
        return $this->createQueryBuilder('h')
            ->orderBy('h.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return array<int|string, array{
     *   habitat: Habitat,
     *   animals: Animal[]
     * }> Returns an array of Habitat objects with animals
     */
    public function getHabitatsWithAnimals(): array
    {
        $habitats = $this->allHabitats();

        $habitatsWithAnimals = [];

        foreach ($habitats as $habitat) {
            $habitatId = $habitat->getId();
            $animals = $habitat->getAnimals()->toArray();

            $habitatsWithAnimals[$habitatId] = [
                'habitat' => $habitat,
                'animals' => $animals,
            ];
        }

        return $habitatsWithAnimals;
    }
}
