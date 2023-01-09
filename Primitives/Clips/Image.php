<?php

namespace Slate\Primitives\Clips;

use JetBrains\PhpStorm\Pure;
use Slate\Primitives\Clips\Traits\HasAnimationsImpl;
use Slate\Primitives\Clips\Traits\HasPositionImpl;
use Slate\Primitives\Clips\Interfaces\HasAnimations;
use Slate\Primitives\Clips\Interfaces\HasPosition;
use Slate\Primitives\Clips\Abstracts\VideoClip;

class Image extends VideoClip implements HasPosition, HasAnimations
{
    use HasPositionImpl, HasAnimationsImpl;

    /**
     * @var string
     */
    protected string $location;

    /**
     * @param string $location
     */
    public function __construct(string $location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    #[Pure] public function checksum(): string
    {
        return md5(
            'l:'.$this->location.
            'p:'.$this->getPosition()->checksum()
        );
    }
}
