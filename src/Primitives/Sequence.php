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
     * @var Coordinate
     */
    protected Coordinate $center;

    /**
     * @var VideoClip[]
     */
    protected array $layers = [];

    /**
     * @var AudioClip[]
     */
    protected array $audio = [];

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
        $this->layers[] = $clip;
        return count($this->layers) - 1;
    }

    /**
     * @param AudioClip $audio
     * @return int
     */
    public function layerAudio(AudioClip $audio): int
    {
        $this->audio[] = $audio;
        return count($this->audio) - 1;
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
