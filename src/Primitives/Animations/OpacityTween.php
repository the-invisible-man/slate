<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

use JetBrains\PhpStorm\Pure;
use TheInvisibleMan\Slate\Engine\Animators\Animator;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;

class OpacityTween implements Animation
{
    use IsAnimation;

    /**
     * @var int
     */
    protected int $startingValue;

    /**
     * @var int
     */
    protected int $targetValue;

    /**
     * @return int
     */
    public function getStartingValue(): int
    {
        return $this->startingValue;
    }

    /**
     * @return int
     */
    public function getTargetValue(): int
    {
        return $this->targetValue;
    }

    /**
     * @return Animator
     */
    #[Pure] public function getAnimator(): Animator
    {
        return new \TheInvisibleMan\Slate\Engine\Animators\OpacityTween;
    }
}
