<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Primitives\Clips\Filters\Opacity;

class FadeIn extends Animator
{
    /**
     * @param VideoClip $clip
     * @param int $startingFrame
     * @param array $frameBuffer
     * @param Animation|\TheInvisibleMan\Slate\Primitives\Animations\FadeIn $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    public function animate(VideoClip $clip, int $startingFrame, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        $speed = $this->calculateSpeed(0, 100, $animationSettings->getDuration());

        $opacityTracker = 0;
        $opacity = (new Opacity)->setOpacity($opacityTracker);
        $clip->addFilter($opacity);
        $this->getOrCreateFrame($startingFrame, $frameBuffer)
             ->layerVideoClip($clip);
        $startingFrame++;

        foreach($this->getOrCreateFrames($startingFrame, $animationSettings->getDuration(), $frameBuffer) as $frame) {
            $opacityTracker += $speed;
            $newClip = $frame->getOrCreateClipByInitialInstance($clip);
            $newOpacity = (new Opacity)->setOpacity($opacityTracker);

            $newClip->addFilter($newOpacity);
        }
    }
}
