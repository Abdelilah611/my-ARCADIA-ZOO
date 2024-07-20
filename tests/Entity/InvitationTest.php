<?php

namespace App\Tests\Entity;

use App\Entity\Invitation;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class InvitationTest extends TestCase
{
    public function testGetSetEmail()
    {
        $invitation = new Invitation();
        $email = 'test@example.com';
        $invitation->setEmail($email);

        $this->assertSame($email, $invitation->getEmail());
    }

    public function testGetSetUuid()
    {
        $invitation = new Invitation();
        $uuid = Uuid::v4();
        $invitation->setUuid($uuid);

        $this->assertSame($uuid, $invitation->getUuid());
    }

    public function testGetSetTheUser()
    {
        $invitation = new Invitation();
        $user = new User();
        $invitation->setTheUser($user);

        $this->assertSame($user, $invitation->getTheUser());
    }

    public function testGetId()
    {
        $invitation = new Invitation();
        $this->assertNull($invitation->getId());
    }
}