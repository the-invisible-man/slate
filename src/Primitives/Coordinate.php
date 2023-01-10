<?php

namespace TheInvisibleMan\Slate\Primitives;

use JetBrains\PhpStorm\Pure;

class Coordinate
{
    /**
     * @var int
     */
    protected int $x, $y;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function checksum(): string
    {
        return ('x:'.$this->x.'y:'.$this->y);
    }

    /**
     * @param int $newX
     * @return $this
     */
    #[Pure] public function x(int $newX): self
    {
        return new self($newX, $this->y);
    }

    /**
     * @param int $operand
     * @return $this
     */
    #[Pure] public function addX(int $operand): self
    {
        return new self ($this->x + $operand, $this->y);
    }

    /**
     * @param int $operand
     * @return $this
     */
    #[Pure] public function addY(int $operand): self
    {
        return new self($this->x, $this->y + $operand);
    }

    /**
     * @param int $newY
     * @return $this
     */
    #[Pure] public function y(int $newY): self
    {
        return new self($this->x, $newY);
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}
