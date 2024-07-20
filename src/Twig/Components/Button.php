<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Button
{
    public string $text;
    public string $size;
    public bool $isPrimary;
    public bool $isCta;
    public bool $isSubmit;
    public string $labelColor;

    public function __construct(
        string $text = '',
        string $size = 'medium',
        bool $isPrimary = true,
        bool $isCta = false,
        bool $isSubmit = false,
        string $labelColor = ''
    ) {
        $this->text = $text;
        $this->size = $size;
        $this->isPrimary = $isPrimary;
        $this->isCta = $isCta;
        $this->isSubmit = $isSubmit;
        $this->labelColor = $labelColor;
    }
}
