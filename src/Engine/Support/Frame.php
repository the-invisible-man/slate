<?php

namespace TheInvisibleMan\Slate\Engine\Support;

use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class Frame
{
    /**
     * @var VideoClip[]
     */
    protected array $layers = [];

    /**
     * @var int[]
     */
    protected array $order = [];

    public function checksum(int $layerDepth = null): string
    {

    }

    /**
     * Layers a video clip and maintains the ID
     *
     * @param VideoClip $clip
     * @return int
     */
    public function layerVideoClip(VideoClip $clip): int
    {
        $clipId = spl_object_id($clip);
        $this->layers[$clipId] = $clip;

        $this->registerOrder($clipId);

        return $clipId;
    }

    /**
     * @param VideoClip $initialClip
     * @return VideoClip
     */
    public function getOrCreateClipByInitialInstance(VideoClip $initialClip): VideoClip
    {
        $clipId = spl_object_id($initialClip);

        if (!isset($this->layers[$clipId])) {
            $this->layers[$clipId] = clone $initialClip;
        }

        return $this->layers[$clipId];
    }

    /**
     * @param int $objectId
     * @return void
     */
    protected function registerOrder(int $objectId): void
    {
        $this->order[] = $objectId;
    }
}
