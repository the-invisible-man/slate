<?php

namespace Slate\Primitives\Clips;

use JetBrains\PhpStorm\Pure;
use Slate\Primitives\Clips\Interfaces\HasAnimations;
use Slate\Primitives\Clips\Traits\HasAnimationsImpl;
use Slate\Primitives\Clips\Traits\HasPositionImpl;
use Slate\Primitives\Clips\Interfaces\HasPosition;
use Slate\Primitives\Clips\Abstracts\VideoClip;

class Rectangle extends VideoClip implements HasPosition, HasAnimations
{
    use HasPositionImpl, HasAnimationsImpl;

    /**
     * @var int
     */
    protected int $height;

    /**
     * @var int
     */
    protected int $width;

    /**
     * @var string
     */
    protected string $color;

    /**
     * @param int $height
     * @param int $width
     */
    public function __construct(int $height, int $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * @return string
     */
    #[Pure] public function checksum(): string
    {
        return md5(
            'h:'.$this->height.
            'w:'.$this->width.
            'c:'.$this->color.
            'p:'.$this->getPosition()->checksum()
        );
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }
}
