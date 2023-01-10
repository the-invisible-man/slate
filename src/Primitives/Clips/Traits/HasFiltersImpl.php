<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Traits;

use TheInvisibleMan\Slate\Primitives\Clips\Filters\Filter;

trait HasFiltersImpl
{
    /**
     * @var Filter[]
     */
    protected array $filters = [];

    /**
     * @param Filter $filter
     * @return $this
     */
    public function addFilter(Filter $filter): static
    {
        $this->filters[] = $filter;
        return $this;
    }
}
