<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

class FadeOut extends OpacityTween
{
    public function __construct()
    {
        $this->startingValue = 100;
        $this->targetValue = 0;
    }
}
