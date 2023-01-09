<?php

namespace Slate\Engine\Support;

class Timeline
{
    /**
     * @var Frame[]
     */
    protected array $frames = [];

    /**
     * @param Frame $frame
     * @return $this
     */
    public function addFrame(Frame $frame): self
    {
        $this->frames[] = $frame;
        return $this;
    }

    /**
     * @return int
     */
    public function duration(): int
    {
        return count($this->frames);
    }
}
