<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Primitives\Clips\Filters\Opacity;

class FadeOut extends Animator
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
        $startingOpacity = 100;
        $targetOpacity = 0;

        $speed = $this->calculateSpeed($startingOpacity, $targetOpacity, $animationSettings->getDuration());

        $opacityTracker = 100;
        $opacity = (new Opacity)->setOpacity($opacityTracker);
        $clip->addFilter($opacity);
        $this->getOrCreateFrame($startingFrame, $frameBuffer)
            ->layerVideoClip($clip);
        $lastFrame = $startingFrame + $animationSettings->getDuration();

        $startingFrame++;

        foreach($this->getOrCreateFrames($startingFrame, $lastFrame - 1, $frameBuffer) as $frame) {
            $opacityTracker += $speed;
            $newClip = $frame->getOrCreateClipByInitialInstance($clip);
            $newOpacity = (new Opacity)->setOpacity($opacityTracker);

            $newClip->addFilter($newOpacity);
        }

        $frame = $this->getOrCreateFrame($lastFrame, $frameBuffer);
        $newClip = $frame->getOrCreateClipByInitialInstance($clip);
        $newOpacity = (new Opacity)->setOpacity($targetOpacity);

        $newClip->addFilter($newOpacity);
    }
}
