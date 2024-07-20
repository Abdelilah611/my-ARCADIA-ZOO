<?php

namespace App\Tests\Entity;

use App\Entity\OpeningHour;
use PHPUnit\Framework\TestCase;

class OpeningHourTest extends TestCase
{
    public function testGetSetDay()
    {
        $openingHour = new OpeningHour();
        $day = 'Monday';
        $openingHour->setDay($day);

        $this->assertSame($day, $openingHour->getDay());
    }

    public function testGetSetOpen()
    {
        $openingHour = new OpeningHour();
        $open = new \DateTime();
        $openingHour->setOpen($open);

        $this->assertSame($open, $openingHour->getOpen());
    }

    public function testGetSetClose()
    {
        $openingHour = new OpeningHour();
        $close = new \DateTime();
        $openingHour->setClose($close);

        $this->assertSame($close, $openingHour->getClose());
    }

    public function testGetId()
    {
        $openingHour = new OpeningHour();
        $this->assertNull($openingHour->getId());
    }
}