<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

use TheInvisibleMan\Slate\Engine\Animators\Animator;
use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

class Freeze implements Animation
{
    use IsAnimation;

    public function getAnimator(): Animator
    {
        return new \TheInvisibleMan\Slate\Engine\Animators\Freeze;
    }
}
