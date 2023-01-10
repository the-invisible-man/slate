<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Filters;

class Opacity implements Filter
{
    /**
     * @var int
     */
    protected int $opacity = 100;

    /**
     * @param int $value
     * @return $this
     */
    public function setOpacity(int $value): self
    {
        $this->opacity = $value;
        return $this;
    }
}
