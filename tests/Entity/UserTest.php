<?php

namespace App\Tests\Entity;

use App\Entity\FoodConsumption;
use App\Entity\User;
use App\Entity\VeterinaryReport;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testGetSetEmail()
    {
        $user = new User();
        $email = 'john@example.com';
        $user->setEmail($email);

        $this->assertSame($email, $user->getEmail());
    }

    public function testGetUserIdentifier()
    {
        $user = new User();
        $email = 'john@example.com';
        $user->setEmail($email);

        $this->assertSame($email, $user->getUserIdentifier());
    }

    public function testGetSetRoles()
    {
        $user = new User();
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        $user->setRoles($roles);

        $this->assertSame($roles, $user->getRoles());
    }

    public function testGetSetPassword()
    {
        $user = new User();
        $password = 'password123';
        $user->setPassword($password);

        $this->assertSame($password, $user->getPassword());
    }

    public function testGetSetFirstname()
    {
        $user = new User();
        $firstname = 'John';
        $user->setFirstname($firstname);

        $this->assertSame($firstname, $user->getFirstname());
    }

    public function testGetSetLastname()
    {
        $user = new User();
        $lastname = 'Doe';
        $user->setLastname($lastname);

        $this->assertSame($lastname, $user->getLastname());
    }

    public function testGetVetReport()
    {
        $user = new User();
        $this->assertEmpty($user->getVetReport());
    }

    public function testAddVetReport()
    {
        $user = new User();
        $vetReport = new VeterinaryReport();

        $user->addVetReport($vetReport);
        $this->assertTrue($user->getVetReport()->contains($vetReport));
        $this->assertSame($user, $vetReport->getVeterinary());
    }

    public function testRemoveVetReport()
    {
        $user = new User();
        $vetReport = new VeterinaryReport();

        $user->addVetReport($vetReport);
        $user->removeVetReport($vetReport);
        $this->assertFalse($user->getVetReport()->contains($vetReport));
        $this->assertNull($vetReport->getVeterinary());
    }

    public function testGetFoodCons()
    {
        $user = new User();
        $this->assertEmpty($user->getFoodCons());
    }

    public function testAddFoodCon()
    {
        $user = new User();
        $foodCon = new FoodConsumption();

        $user->addFoodCon($foodCon);
        $this->assertTrue($user->getFoodCons()->contains($foodCon));
        $this->assertSame($user, $foodCon->getEmployee());
    }

    public function testRemoveFoodCon()
    {
        $user = new User();
        $foodCon = new FoodConsumption();

        $user->addFoodCon($foodCon);
        $user->removeFoodCon($foodCon);
        $this->assertFalse($user->getFoodCons()->contains($foodCon));
        $this->assertNull($foodCon->getEmployee());
    }

    public function testToString()
    {
        $user = new User();
        $firstname = 'John';
        $user->setFirstname($firstname);
        $lastname = 'Doe';
        $user->setLastname($lastname);

        $expectedString = 'John Doe';
        $this->assertSame($expectedString, (string) $user);
    }

    public function testGetFormattedRoles()
    {
        $user = new User();
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        $user->setRoles($roles);

        $expectedString = 'ROLE_ADMIN, ROLE_USER';
        $this->assertSame($expectedString, $user->getFormattedRoles());
    }

}