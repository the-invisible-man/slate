<?php

namespace TheInvisibleMan\Slate\Primitives\Animations\Interfaces;

use TheInvisibleMan\Slate\Engine\Animators\Animator;

interface Animation
{
    /**
     * @param int $frames
     * @return $this
     */
    public function setDuration(int $frames): static;

    /**
     * @return int
     */
    public function getDuration(): int;

    /**
     * @return string
     */
    public function getAnimator(): string;
}
