<?php

namespace TheInvisibleMan\Slate\Engine\Support;

class Timeline
{
    /**
     * @var Frame[]
     */
    protected array $frames = [];

    /**
     * @param Frame $frame
     * @param int $frameNumber
     * @return $this
     */
    public function addFrame(Frame $frame, int $frameNumber): self
    {
        $this->frames[$frameNumber] = $frame;
        return $this;
    }

    /**
     * @return Frame[]
     */
    public function getFrames(): array
    {
        return $this->frames;
    }

    /**
     * @param array $frames
     * @return void
     */
    public function appendFrames(array $frames): void
    {
        $this->frames = array_merge($this->frames, $frames);
    }

    /**
     * @param int $frameNumber
     * @return Frame
     */
    public function getFrame(int $frameNumber): Frame
    {
        if (!isset($this->frames[$frameNumber])) {
            throw new \RuntimeException("Render failure: frame number {$frameNumber} is invalid.");
        }

        return $this->frames[$frameNumber];
    }

    /**
     * @return int
     */
    public function duration(): int
    {
        return count($this->frames);
    }
}
