<?php

namespace App\Entity;

use App\Entity\Trait\ReportsTrait;
use App\Repository\VeterinaryReportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VeterinaryReportRepository::class)]
class VeterinaryReport
{
    use ReportsTrait;

    #[ORM\ManyToOne(inversedBy: 'vetReport')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $veterinary = null;

    #[ORM\ManyToOne(inversedBy: 'vetReport')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    public function getVeterinary(): ?User
    {
        return $this->veterinary;
    }

    public function setVeterinary(?User $veterinary): static
    {
        $this->veterinary = $veterinary;

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
