<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

class FadeIn extends OpacityTween
{
    public function __construct()
    {
        $this->startingValue = 0;
        $this->targetValue = 100;
    }
}
