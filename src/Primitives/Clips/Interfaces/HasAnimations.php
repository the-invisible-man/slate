<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Interfaces;

use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

interface HasAnimations
{
    /**
     * @param Animation $animation
     * @return $this
     */
    public function addAnimation(Animation $animation): static;

    /**
     * @return Animation[]
     */
    public function getAnimations(): array;
}
