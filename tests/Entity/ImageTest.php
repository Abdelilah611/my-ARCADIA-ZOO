<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Service;
use App\Entity\Habitat;
use App\Entity\Animal;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetId()
    {
        $image = new Image();
        $this->assertNull($image->getId());
    }

    public function testGetSetTitle()
    {
        $image = new Image();
        $title = 'Image Title';
        $image->setTitle($title);

        $this->assertSame($title, $image->getTitle());
    }

    public function testGetSetImagePath()
    {
        $image = new Image();
        $imagePath = '/path/to/image.jpg';
        $image->setImagePath($imagePath);

        $this->assertSame($imagePath, $image->getImagePath());
    }

    public function testGetServices()
    {
        $image = new Image();
        $service1 = new Service();
        $service2 = new Service();
        $image->addService($service1);
        $image->addService($service2);

        $services = $image->getServices();

        $this->assertCount(2, $services);
        $this->assertContains($service1, $services);
        $this->assertContains($service2, $services);
    }

    public function testAddRemoveService()
    {
        $image = new Image();
        $service = new Service();
        $image->addService($service);

        $services = $image->getServices();
        $this->assertCount(1, $services);
        $this->assertContains($service, $services);

        $image->removeService($service);

        $services = $image->getServices();
        $this->assertCount(0, $services);
        $this->assertNotContains($service, $services);
    }

    public function testGetHabitats()
    {
        $image = new Image();
        $habitat1 = new Habitat();
        $habitat2 = new Habitat();
        $image->addHabitat($habitat1);
        $image->addHabitat($habitat2);

        $habitats = $image->getHabitats();

        $this->assertCount(2, $habitats);
        $this->assertContains($habitat1, $habitats);
        $this->assertContains($habitat2, $habitats);
    }

    public function testAddRemoveHabitat()
    {
        $image = new Image();
        $habitat = new Habitat();
        $image->addHabitat($habitat);

        $habitats = $image->getHabitats();
        $this->assertCount(1, $habitats);
        $this->assertContains($habitat, $habitats);

        $image->removeHabitat($habitat);

        $habitats = $image->getHabitats();
        $this->assertCount(0, $habitats);
        $this->assertNotContains($habitat, $habitats);
    }

    public function testGetAnimals()
    {
        $image = new Image();
        $animal1 = new Animal();
        $animal2 = new Animal();
        $image->addAnimal($animal1);
        $image->addAnimal($animal2);

        $animals = $image->getAnimals();

        $this->assertCount(2, $animals);
        $this->assertContains($animal1, $animals);
        $this->assertContains($animal2, $animals);
    }

    public function testAddRemoveAnimal()
    {
        $image = new Image();
        $animal = new Animal();
        $image->addAnimal($animal);

        $animals = $image->getAnimals();
        $this->assertCount(1, $animals);
        $this->assertContains($animal, $animals);

        $image->removeAnimal($animal);

        $animals = $image->getAnimals();
        $this->assertCount(0, $animals);
        $this->assertNotContains($animal, $animals);
    }

    public function testToString()
    {
        $image = new Image();
        $title = 'Image Title';
        $image->setTitle($title);

        $this->assertSame($title, (string)$image);
    }
}