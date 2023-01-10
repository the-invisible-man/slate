<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

use TheInvisibleMan\Slate\Engine\Animators\Animator;
use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

class FadeOut implements Animation
{
    use IsAnimation;

    /**
     * @return Animator
     */
    public function getAnimator(): Animator
    {
        return new \TheInvisibleMan\Slate\Engine\Animators\FadeOut;
    }
}
