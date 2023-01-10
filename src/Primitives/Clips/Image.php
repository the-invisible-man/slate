<?php

namespace TheInvisibleMan\Slate\Primitives\Clips;

use JetBrains\PhpStorm\Pure;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class Image extends VideoClip
{
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
