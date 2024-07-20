<?php

namespace App\Entity;

use App\Entity\Trait\IdLabelTrait;
use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    use IdLabelTrait;
}
