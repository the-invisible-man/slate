<?php

namespace TheInvisibleMan\Slate\Primitives\Animations\Interfaces;

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
}
