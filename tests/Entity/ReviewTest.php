<?php

namespace App\Tests\Entity;

use App\Entity\Review;
use PHPUnit\Framework\TestCase;

class ReviewTest extends TestCase
{
    public function testGetSetPseudo()
    {
        $review = new Review();
        $pseudo = 'JohnDoe';
        $review->setPseudo($pseudo);

        $this->assertSame($pseudo, $review->getPseudo());
    }

    public function testGetSetComment()
    {
        $review = new Review();
        $comment = 'This is a great place!';
        $review->setComment($comment);

        $this->assertSame($comment, $review->getComment());
    }

    public function testGetSetIsVisible()
    {
        $review = new Review();
        $isVisible = true;
        $review->setIsVisible($isVisible);

        $this->assertSame($isVisible, $review->isIsVisible());
    }

    public function testGetId()
    {
        $review = new Review();
        $this->assertNull($review->getId());
    }
}