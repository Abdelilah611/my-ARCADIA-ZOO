<?php

namespace App\Tests\Entity;

use App\Entity\FoodConsumption;
use App\Entity\Animal;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class FoodConsumptionTest extends TestCase
{

    public function testGetId()
    {
        $foodCon = new FoodConsumption();
        $this->assertNull($foodCon->getId());
    }

    public function testGetSetDate()
    {
        $foodCon = new FoodConsumption();
        $date = new \DateTime();
        $foodCon->setDate($date);

        $this->assertSame($date, $foodCon->getDate());
    }

    public function testGetSetDetail()
    {
        $foodCon = new FoodConsumption();
        $foodCon->setDetail('test');

        $this->assertSame('test', $foodCon->getDetail());
    }
    
    public function testGetSetEmployee()
    {
        $foodCon = new FoodConsumption();
        $employee = new User();
        $foodCon->setEmployee($employee);

        $this->assertSame($employee, $foodCon->getEmployee());
    }

    public function testGetSetAnimal()
    {
        $foodCon = new FoodConsumption();
        $animal = new Animal();
        $foodCon->setAnimal($animal);

        $this->assertSame($animal, $foodCon->getAnimal());
    }

    public function testToString()
    {
        $foodCon = new FoodConsumption();
        $animal = new Animal();
        $animal->setName('Lion');
        $foodCon->setAnimal($animal);
        $date = new \DateTime('2022-01-01');
        $foodCon->setDate($date);

        $expectedString = '2022-01-01 - Lion';
        $this->assertSame($expectedString, (string) $foodCon);
    }
    
}