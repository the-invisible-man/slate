<?php

namespace TheInvisibleMan\Slate\Engine\Support;

use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class Frame
{
    /**
     * @var VideoClip[]
     */
    protected array $layers = [];

    public function checksum(int $layerDepth = null): string
    {

    }
}
