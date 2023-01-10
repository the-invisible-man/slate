<?php

namespace TheInvisibleMan\Slate\Primitives\Animations;

use TheInvisibleMan\Slate\Engine\Animators\Animator;
use TheInvisibleMan\Slate\Exceptions\AnimationException;
use TheInvisibleMan\Slate\Primitives\Animations\Traits\IsAnimation;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

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

        if ($animation instanceof self) {
            throw new AnimationException("Compounds cannot contain other Compounds.");
        }

        $this->animations[] = $animation;

        return $this;
    }

    /**
     * @return Animation[]
     */
    public function getAnimations(): array
    {
        return $this->animations;
    }

    /**
     * @param Animation $animation
     * @return bool
     */
    protected function isValidCompound(Animation $animation): bool
    {
        return $this->animations[0]->getDuration() !== $animation->getDuration();
    }

    /**
     * @return Animator
     */
    public function getAnimator(): Animator
    {
        return new \TheInvisibleMan\Slate\Engine\Animators\Compound;
    }
}
