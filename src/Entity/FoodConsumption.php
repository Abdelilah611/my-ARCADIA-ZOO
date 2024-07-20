<?php

namespace App\Entity;

use App\Entity\Trait\ReportsTrait;
use App\Repository\FoodConsumptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodConsumptionRepository::class)]
class FoodConsumption
{
    use ReportsTrait;

    #[ORM\ManyToOne(inversedBy: 'foodCons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;

    #[ORM\ManyToOne(inversedBy: 'foodCons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function __toString(): string
    {
        // Format the message as "[date] - [animal]"
        $formattedDate = $this->getDate()->format('Y-m-d');
        $animalName = $this->getAnimal()->getName();

        return sprintf('%s - %s', $formattedDate, $animalName);
    }
}
