<?php

namespace TheInvisibleMan\Slate\Primitives;

use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\AudioClip;

class Sequence
{
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
    protected string $background;

    /**
     * @var int
     */
    protected int $duration = 0;

    /**
     * @var Coordinate
     */
    protected Coordinate $center;

    /**
     * @var VideoClip[]
     */
    protected array $videoLayers = [];

    /**
     * @var AudioClip[]
     */
    protected array $audioLayers = [];

    /**
     * @return Coordinate
     */
    public function center(): Coordinate
    {
        if (!isset($this->center)) {
            $x = $this->width / 2;
            $y = $this->height / 2;

            $this->center = new Coordinate($x, $y);
        }

        return $this->center;
    }

    /**
     * @param VideoClip $clip
     * @return int
     */
    public function layerVideoClip(VideoClip $clip): int
    {
        $this->videoLayers[] = $clip;

        if ($this->duration < $clip->getDuration()) {
            $this->duration = $clip->getDuration();
        }

        return count($this->videoLayers) - 1;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param AudioClip $audio
     * @return int
     */
    public function layerAudio(AudioClip $audio): int
    {
        $this->audioLayers[] = $audio;
        return count($this->audioLayers) - 1;
    }

    /**
     * @return VideoClip[]
     */
    public function getVideoClips(): array
    {
        return $this->videoLayers;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param string $background
     * @return $this
     */
    public function setBackground(string $background): self
    {
        $this->background = $background;
        return $this;
    }
}
