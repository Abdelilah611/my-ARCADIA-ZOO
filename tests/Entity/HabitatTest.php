<?php

namespace App\Tests\Entity;

use App\Entity\Habitat;
use App\Entity\Animal;
use App\Entity\Image;
use PHPUnit\Framework\TestCase;

class HabitatTest extends TestCase
{
    public function testGetSetLabel()
    {
        $habitat = new Habitat();
        $label = 'Forest';
        $habitat->setLabel($label);

        $this->assertSame($label, $habitat->getLabel());
    }

    public function testGetSetDescription()
    {
        $habitat = new Habitat();
        $description = 'A lush green forest with diverse wildlife.';
        $habitat->setDescription($description);

        $this->assertSame($description, $habitat->getDescription());
    }

    public function testGetSetHabitComment()
    {
        $habitat = new Habitat();
        $habitComment = 'This habitat is suitable for various bird species.';
        $habitat->setHabitComment($habitComment);

        $this->assertSame($habitComment, $habitat->getHabitComment());
    }

    public function testAddRemoveImage()
    {
        $habitat = new Habitat();
        $image = new Image();

        $habitat->addImage($image);
        $this->assertTrue($habitat->getImages()->contains($image));

        $habitat->removeImage($image);
        $this->assertFalse($habitat->getImages()->contains($image));
    }

    public function testAddRemoveAnimal()
    {
        $habitat = new Habitat();
        $animal = new Animal();

        $habitat->addAnimal($animal);
        $this->assertTrue($habitat->getAnimals()->contains($animal));
        $this->assertSame($habitat, $animal->getHabitat());

        $habitat->removeAnimal($animal);
        $this->assertFalse($habitat->getAnimals()->contains($animal));
        $this->assertNull($animal->getHabitat());
    }

    public function testGetId()
    {
        $habitat = new Habitat();
        $this->assertNull($habitat->getId());
    }

    public function testToString()
    {
        $habitat = new Habitat();
        $habitat->setLabel('Forest');

        $this->assertSame('Forest', (string) $habitat);
    }
    
}