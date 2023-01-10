<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Engine\Support\Frame;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

abstract class Animator
{
    /**
     * @param VideoClip $clip
     * @param array $frameBuffer
     * @param Animation|mixed $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    abstract public function animate(VideoClip $clip, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void;

    /**
     * @param int $frameNumber
     * @param array $frameBuffer
     * @return Frame
     */
    protected function getOrCreateFrame(int $frameNumber, array &$frameBuffer): Frame
    {
        if (!isset($frameBuffer[$frameNumber])) {
            $frameBuffer[$frameNumber] = new Frame;
        }

        return $frameBuffer[$frameNumber];
    }

    /**
     * Generator for when working with multiple frames. Helpful with animations.
     *
     * @param int $start
     * @param int $end
     * @param array $frameBuffer
     * @return \Iterator
     */
    protected function getOrCreateFrames(int $start, int $end, array &$frameBuffer): \Iterator
    {
        for ($i = $start; $i <= $end; $i++) {
            yield $this->getOrCreateFrame($i, $frameBuffer);
        }
    }

    /**
     * Calculates the necessary speed a value need to increase by to reach its destination
     * within a given number of frames.
     *
     * @param int $startingValue
     * @param int $endingValue
     * @param int $duration
     * @return int
     */
    protected function calculateSpeed(int $startingValue, int $endingValue, int $duration): int
    {
        $distance = $endingValue - $startingValue;
        return (int) ($distance / $duration);
    }
}
