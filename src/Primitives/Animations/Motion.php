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
    protected Coordinate $startingPosition;

    /**
     * @var Coordinate
     */
    protected Coordinate $endingPosition;

    /**
     * @return Coordinate
     */
    public function getStartingPosition(): Coordinate
    {
        return $this->startingPosition;
    }

    /**
     * @param Coordinate $startingPosition
     * @return $this
     */
    public function setStartingPosition(Coordinate $startingPosition): self
    {
        $this->startingPosition = $startingPosition;
        return $this;
    }

    /**
     * @return Coordinate
     */
    public function getEndingPosition(): Coordinate
    {
        return $this->endingPosition;
    }

    /**
     * @param Coordinate $endingPosition
     * @return $this
     */
    public function setEndingPosition(Coordinate $endingPosition): self
    {
        $this->endingPosition = $endingPosition;
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
