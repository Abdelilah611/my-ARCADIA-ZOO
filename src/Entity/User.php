<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    /**
     * @var Collection<int, VeterinaryReport>
     */
    #[ORM\OneToMany(targetEntity: VeterinaryReport::class, mappedBy: 'veterinary')]
    private Collection $vetReport;

    /**
     * @var Collection<int, FoodConsumption>
     */
    #[ORM\OneToMany(targetEntity: FoodConsumption::class, mappedBy: 'employee')]
    private Collection $foodCons;

    public function __construct()
    {
        $this->vetReport = new ArrayCollection();
        $this->foodCons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, VeterinaryReport>
     */
    public function getVetReport(): Collection
    {
        return $this->vetReport;
    }

    public function addVetReport(VeterinaryReport $vetReport): static
    {
        if (!$this->vetReport->contains($vetReport)) {
            $this->vetReport->add($vetReport);
            $vetReport->setVeterinary($this);
        }

        return $this;
    }

    public function removeVetReport(VeterinaryReport $vetReport): static
    {
        if ($this->vetReport->removeElement($vetReport)) {
            // set the owning side to null (unless already changed)
            if ($vetReport->getVeterinary() === $this) {
                $vetReport->setVeterinary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FoodConsumption>
     */
    public function getFoodCons(): Collection
    {
        return $this->foodCons;
    }

    public function addFoodCon(FoodConsumption $foodCon): static
    {
        if (!$this->foodCons->contains($foodCon)) {
            $this->foodCons->add($foodCon);
            $foodCon->setEmployee($this);
        }

        return $this;
    }

    public function removeFoodCon(FoodConsumption $foodCon): static
    {
        if ($this->foodCons->removeElement($foodCon)) {
            // set the owning side to null (unless already changed)
            if ($foodCon->getEmployee() === $this) {
                $foodCon->setEmployee(null);
            }
        }

        return $this;
    }

    public function getFormattedRoles(): string
    {
        return implode(', ', $this->getRoles());
    }

    public function __toString(): string
    {
        return $this->getFirstname().' '.$this->getLastname();
    }
}
