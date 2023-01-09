<?php

namespace Slate\Primitives\Clips\Interfaces;

use Slate\Primitives\Animations\Interfaces\Animation;

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
