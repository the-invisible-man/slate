<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Interfaces;

use TheInvisibleMan\Slate\Primitives\Clips\Filters\Filter;

interface HasFilters
{
    public function addFilter(Filter $filter): static;
}
