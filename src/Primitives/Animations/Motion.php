<?php

namespace TheInvisibleMan\Slate\Primitives\Animations\Interfaces;

use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;
use TheInvisibleMan\Slate\Primitives\Coordinate;

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
}
