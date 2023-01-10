<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Engine\Support\Frame;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Primitives\Animations\Motion as MotionAnimation;

class Motion extends Animator
{
    /**
     * The Motion animator takes a video clip, a start and ending position,
     * and calculates the values in between.
     *
     * @param VideoClip $clip
     * @param Frame[] $frameBuffer
     * @param Animation|MotionAnimation $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    public function animate(VideoClip $clip, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        $speedX = $this->speedCalculator(
            $animationSettings->getStartingPosition()->getX(),
            $animationSettings->getEndingPosition()->getX(),
            $animationSettings->getDuration())
        ;

        $speedY = $this->speedCalculator(
            $animationSettings->getStartingPosition()->getY(),
            $animationSettings->getEndingPosition()->getY(),
            $animationSettings->getDuration()
        );

        // Set first frame. Position should be the same
        $frame = $this->getOrCreateFrame(0, $frameBuffer);
        $frame->layerVideoClip($clip);

        for ($i = 1; $i <= $animationSettings->getDuration(); $i++) {
            $frame = $this->getOrCreateFrame($i, $frameBuffer);
            $newFrameClip = clone $clip;

            $newPosition = $clip->getPosition()->addX($speedX)
                                               ->addY($speedY);

            $newFrameClip->setPosition($newPosition);
            $frame->layerVideoClip($newFrameClip);
        }
    }
}
