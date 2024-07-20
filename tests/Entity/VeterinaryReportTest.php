<?php

namespace App\Tests\Entity;

use App\Entity\VeterinaryReport;
use App\Entity\User;
use App\Entity\Animal;
use PHPUnit\Framework\TestCase;

class VeterinaryReportTest extends TestCase
{
    public function testGetSetVeterinary()
    {
        $report = new VeterinaryReport();
        $veterinary = new User();
        $report->setVeterinary($veterinary);

        $this->assertSame($veterinary, $report->getVeterinary());
    }

    public function testGetSetAnimal()
    {
        $report = new VeterinaryReport();
        $animal = new Animal();
        $report->setAnimal($animal);

        $this->assertSame($animal, $report->getAnimal());
    }

    public function testToString()
    {
        $report = new VeterinaryReport();
        $animal = new Animal();
        $animal->setName('Lion');
        $report->setAnimal($animal);
        $date = new \DateTime('2022-01-01');
        $report->setDate($date);

        $expectedString = '2022-01-01 - Lion';
        $this->assertSame($expectedString, (string) $report);
    }
}