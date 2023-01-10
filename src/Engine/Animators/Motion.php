<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Engine\Support\Frame;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Primitives\Animations\Motion as MotionAnimation;
use TheInvisibleMan\Slate\Primitives\Coordinate;

class Motion extends Animator
{
    /**
     * The Motion animator takes a video clip, a start and ending position,
     * and calculates the values in between.
     *
     * @param VideoClip $clip
     * @param int $startingFrame
     * @param Frame[] $frameBuffer
     * @param Animation|MotionAnimation $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    public function animate(VideoClip $clip, int $startingFrame, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        $speedX = $this->calculateSpeed(
            $animationSettings->getStartingPosition()->getX(),
            $animationSettings->getEndingPosition()->getX(),
            $animationSettings->getDuration()
        );

        $speedY = $this->calculateSpeed(
            $animationSettings->getStartingPosition()->getY(),
            $animationSettings->getEndingPosition()->getY(),
            $animationSettings->getDuration()
        );

        // Set first frame. Position should be the same
        $frame = $this->getOrCreateFrame($startingFrame, $frameBuffer);
        $frame->layerVideoClip($clip);
        $startingFrame++;

        $lastX = $clip->getPosition()->getX();
        $lastY = $clip->getPosition()->getY();

        foreach($this->getOrCreateFrames($startingFrame, $animationSettings->getDuration(), $frameBuffer) as $frame) {
            $lastX += $speedX;
            $lastY += $speedY;

            $newFrameClip = $frame->getOrCreateClipByInitialInstance($clip);
            $newFrameClip->setPosition(new Coordinate($lastX, $lastY));
        }
    }
}
