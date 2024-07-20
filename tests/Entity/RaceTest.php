<?php

namespace App\Tests\Entity;

use App\Entity\Race;
use App\Entity\Animal;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public function testGetId()
    {
        $race = new Race();
        $this->assertNull($race->getId());
    }

    public function testGetSetLabel()
    {
        $race = new Race();
        $race->setLabel('test');

        $this->assertSame('test', $race->getLabel());
    }

    public function testAddRemoveAnimal()
    {
        $race = new Race();
        $animal = new Animal();

        $race->addAnimal($animal);
        $this->assertTrue($race->getAnimals()->contains($animal));
        $this->assertSame($race, $animal->getRace());

        $race->removeAnimal($animal);
        $this->assertFalse($race->getAnimals()->contains($animal));
        $this->assertNull($animal->getRace());
    }

    public function testToString()
    {
        $race = new Race();
        $race->setLabel('Lion');

        $this->assertSame('Lion', (string) $race);
    }
    
}