<?php

namespace Slate\Engine\Support;

use Slate\Primitives\Clips\Abstracts\VideoClip;

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
