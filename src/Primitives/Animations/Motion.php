<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

use TheInvisibleMan\Slate\Engine\Animators\Animator;
use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;
use TheInvisibleMan\Slate\Primitives\Coordinate;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

class Motion implements Animation
{
    use IsAnimation;

    /**
     * @var Coordinate
     */
    protected Coordinate $targetPosition;

    /**
     * @return Coordinate
     */
    public function getTargetPosition(): Coordinate
    {
        return $this->targetPosition;
    }

    /**
     * @param Coordinate $endingPosition
     * @return $this
     */
    public function setTargetPosition(Coordinate $endingPosition): self
    {
        $this->targetPosition = $endingPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnimator(): Animator
    {
        return new \TheInvisibleMan\Slate\Engine\Animators\Motion;
    }
}
