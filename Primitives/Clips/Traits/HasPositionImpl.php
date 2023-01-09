<?php

namespace Slate\Primitives\Clips\Traits;

use Slate\Primitives\Coordinate;

trait HasPositionImpl
{
    protected Coordinate $position;

    /**
     * @return Coordinate
     */
    public function getPosition(): Coordinate
    {
        return $this->position;
    }

    /**
     * @param Coordinate $position
     * @return $this
     */
    public function setPosition(Coordinate $position): static
    {
        $this->position = $position;
        return $this;
    }
}
