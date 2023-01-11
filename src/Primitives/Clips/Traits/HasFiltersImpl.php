<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Traits;

use TheInvisibleMan\Slate\Exceptions\FilterException;
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
        $filterType = basename(get_class($filter));
        $this->filters[$filterType] = $filter;

        return $this;
    }

    /**
     * @param string $type
     * @return bool
     * @throws FilterException
     */
    public function hasFilter(string $type): bool
    {
        if (!class_exists($type) || !in_array(Filter::class, class_parents($type), true)) {
            throw new FilterException("Filter type \"{$type}\" does not exist. Make sure you are passing the filter class' fully qualified name.");
        }

        return isset($this->filters[basename($type)]);
    }

    /**
     * @param string $type
     * @return void
     * @throws FilterException
     */
    public function removeFilter(string $type): void
    {
        $filterType = basename($type);

        if (!isset($this->filters[$filterType])) {
            throw new FilterException("Filter type \"{$type}\" is not set. Make sure that the filter exists by"
            ." calling VideoClip::hasFilter() and that you are always passing the filter class' fully qualified name.");
        }
    }

    /**
     * @return Filter[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}
