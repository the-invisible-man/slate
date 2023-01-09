<?php

namespace Slate\Primitives\Animations\Interfaces;

use Slate\Exceptions\AnimationException;
use Slate\Primitives\Animations\Traits\IsAnimation;

class Compound implements Animation
{
    use IsAnimation;

    /**
     * @var Animation[]
     */
    protected array $animations = [];

    /**
     * @param Animation $animation
     * @return $this
     * @throws AnimationException
     */
    public function add(Animation $animation): self
    {
        if (count($this->animations) && $this->isValidCompound($animation)) {
            throw new AnimationException("Compound animations should comprise animations of the same length");
        }

        $this->animations[] = $animation;

        return $this;
    }

    /**
     * @param Animation $animation
     * @return bool
     */
    protected function isValidCompound(Animation $animation): bool
    {
        return $this->animations[0]->getDuration() !== $animation->getDuration();
    }
}
