<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Filters;

abstract class Filter
{
    /**
     * @return array
     */
    abstract public function serialize(): array;
}
