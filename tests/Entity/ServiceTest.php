<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Service;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    public function testGetSetLabel()
    {
        $service = new Service();
        $label = 'Test Label';
        $service->setLabel($label);

        $this->assertSame($label, $service->getLabel());
    }

    public function testGetSetDescription()
    {
        $service = new Service();
        $description = 'Test Description';
        $service->setDescription($description);

        $this->assertSame($description, $service->getDescription());
    }

    public function testGetImages()
    {
        $service = new Service();
        $this->assertInstanceOf(ArrayCollection::class, $service->getImages());
    }

    public function testAddImage()
    {
        $service = new Service();
        $image = new Image();
        $service->addImage($image);

        $this->assertTrue($service->getImages()->contains($image));
    }

    public function testRemoveImage()
    {
        $service = new Service();
        $image = new Image();
        $service->addImage($image);
        $service->removeImage($image);

        $this->assertFalse($service->getImages()->contains($image));
    }

    public function testGetId()
    {
        $service = new Service();
        $this->assertNull($service->getId());
    }

    public function testToString()
    {
        $service = new Service();
        $service->setLabel('Test Label');

        $this->assertSame('Test Label', (string) $service);
    }
    
}