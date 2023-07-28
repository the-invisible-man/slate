<?php

namespace TheInvisibleMan\Slate\Primitives;

class Composition
{
    /**
     * @var Sequence[]
     */
    protected array $sequences = [];

    /**
     * @var int
     */
    protected int $duration = 0;

    /**
     * @param Sequence $sequence
     * @return $this
     */
    public function append(Sequence $sequence): self
    {
        $this->sequences[] = $sequence;
        $this->duration += $sequence->getDuration();

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @return Sequence[]
     */
    public function getSequences(): array
    {
        return $this->sequences;
    }
}
