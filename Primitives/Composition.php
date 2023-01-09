<?php

namespace Slate\Primitives;

class Composition
{
    /**
     * @var Sequence[]
     */
    protected array $sequences = [];

    /**
     * @param Sequence $sequence
     * @return $this
     */
    public function append(Sequence $sequence): self
    {
        $this->sequences[] = $sequence;
        return $this;
    }
}
