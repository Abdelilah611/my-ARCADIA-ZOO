<?php

namespace App\Tests\Entity;

use App\Entity\Animal;
use App\Entity\Race;
use App\Entity\Image;
use App\Entity\Habitat;
use App\Entity\FoodConsumption;
use App\Entity\VeterinaryReport;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    public function testSetName()
    {
        $animal = new Animal();
        $animal->setName('Lion');

        $this->assertEquals('Lion', $animal->getName());
    }

    public function testSetState()
    {
        $animal = new Animal();
        $animal->setState('Active');

        $this->assertEquals('Active', $animal->getState());
    }

    public function testSetWeight()
    {
        $animal = new Animal();
        $animal->setWeight('150.50');

        $this->assertEquals('150.50', $animal->getWeight());
    }

    public function testSetSize()
    {
        $animal = new Animal();
        $animal->setSize('5.75');

        $this->assertEquals('5.75', $animal->getSize());
    }

    public function testSetRace()
    {
        $animal = new Animal();
        $race = new Race();
        $animal->setRace($race);

        $this->assertSame($race, $animal->getRace());
    }

    public function testAddImage()
    {
        $animal = new Animal();
        $image = new Image();
        $animal->addImage($image);

        $this->assertTrue($animal->getImages()->contains($image));
    }

    public function testRemoveImage()
    {
        $animal = new Animal();
        $image = new Image();
        $animal->addImage($image);
        $animal->removeImage($image);

        $this->assertFalse($animal->getImages()->contains($image));
    }

    public function testSetHabitat()
    {
        $animal = new Animal();
        $habitat = new Habitat();
        $animal->setHabitat($habitat);

        $this->assertSame($habitat, $animal->getHabitat());
    }

    public function testAddFoodCon()
    {
        $animal = new Animal();
        $foodCon = new FoodConsumption();
        $animal->addFoodCon($foodCon);

        $this->assertTrue($animal->getFoodCons()->contains($foodCon));
        $this->assertSame($animal, $foodCon->getAnimal());
    }

    public function testRemoveFoodCon()
    {
        $animal = new Animal();
        $foodCon = new FoodConsumption();
        $animal->addFoodCon($foodCon);
        $animal->removeFoodCon($foodCon);

        $this->assertFalse($animal->getFoodCons()->contains($foodCon));
        $this->assertNull($foodCon->getAnimal());
    }

    public function testAddVetReport()
    {
        $animal = new Animal();
        $vetReport = new VeterinaryReport();
        $animal->addVetReport($vetReport);

        $this->assertTrue($animal->getVetReport()->contains($vetReport));
        $this->assertSame($animal, $vetReport->getAnimal());
    }

    public function testRemoveVetReport()
    {
        $animal = new Animal();
        $vetReport = new VeterinaryReport();
        $animal->addVetReport($vetReport);
        $animal->removeVetReport($vetReport);

        $this->assertFalse($animal->getVetReport()->contains($vetReport));
        $this->assertNull($vetReport->getAnimal());
    }

    public function testGetId()
    {
        $animal = new Animal();
        $this->assertNull($animal->getId());
    }

    public function testToString()
    {
        $animal = new Animal();
        $race = new Race();
        $animal->setName('Lion');
        $animal->setRace($race);
        $race->setLabel('Lion');

        $this->assertSame('Lion - Lion', (string) $animal);
    }

}