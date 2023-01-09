<?php

namespace Slate\Primitives\Clips\Interfaces;

use Slate\Primitives\Coordinate;

interface HasPosition
{
    /**
     * @param Coordinate $position
     * @return $this
     */
    public function setPosition(Coordinate $position): static;

    /**
     * @return Coordinate
     */
    public function getPosition(): Coordinate;
}
