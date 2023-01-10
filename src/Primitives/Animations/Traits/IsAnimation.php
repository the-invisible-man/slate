<?php

namespace TheInvisibleMan\Slate\Primitives\Animations\Traits;

trait IsAnimation
{
    /**
     * Total frame duration
     *
     * @var int
     */
    protected int $duration = 0;

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return $this
     */
    public function setDuration(int $duration): static
    {
        $this->duration = $duration;
        return $this;
    }
}
