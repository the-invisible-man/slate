<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

class FadeIn implements Animation
{
    use IsAnimation;

    public function getAnimator(): string
    {
        // TODO: Implement getAnimator() method.
    }
}
