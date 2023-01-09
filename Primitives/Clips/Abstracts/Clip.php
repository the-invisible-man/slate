<?php

namespace Slate\Primitives\Clips\Abstracts;

abstract class Clip
{
    /**
     * Total duration of the clip
     *
     * @var int
     */
    protected int $duration = 1;

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $frames
     * @return $this
     */
    public function setDuration(int $frames): static
    {
        $this->duration = $frames;
        return $this;
    }
}
