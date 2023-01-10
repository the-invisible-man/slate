<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Traits;

use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;

trait HasAnimationsImpl
{
    /**
     * @var Animation[]
     */
    protected array $animationStack = [];

    /**
     * @return int
     */
    abstract public function getDuration(): int;

    /**
     * @param int $frames
     * @return $this
     */
    abstract protected function setDuration(int $frames): static;

    /**
     * @param Animation $animation
     * @return $this
     */
    public function addAnimation(Animation $animation): static
    {
        if (count($this->animationStack) === 0) {
            $this->setDuration(0);
        }

        $this->animationStack[] = $animation;
        $this->setDuration($animation->getDuration() + $this->getDuration());

        return $this;
    }

    /**
     * @return Animation[]
     */
    public function getAnimations(): array
    {
        return $this->animationStack;
    }
}
