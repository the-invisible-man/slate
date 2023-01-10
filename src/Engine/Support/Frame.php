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

    /**
     * @param VideoClip $clip
     * @return void
     */
    public function layerVideoClip(VideoClip $clip): void
    {
        $this->layers[] = $clip;
    }
}
