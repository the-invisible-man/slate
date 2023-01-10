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
     * @param array $frameBuffer
     * @param Animation|\TheInvisibleMan\Slate\Primitives\Animations\FadeIn $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    public function animate(VideoClip $clip, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        $speed = $this->calculateSpeed(0, 100, $animationSettings->getDuration());

        $opacityTracker = 100;
        $opacity = (new Opacity)->setOpacity($opacityTracker);
        $clip->addFilter($opacity);
        $this->getOrCreateFrame(0, $frameBuffer)
            ->layerVideoClip($clip);

        foreach($this->getOrCreateFrames(1, $animationSettings->getDuration(), $frameBuffer) as $frame) {
            $newClip = $frame->getOrCreateClipByInitialInstance($clip);
            $newOpacity = (new Opacity)->setOpacity($opacityTracker - $speed);

            $newClip->addFilter($newOpacity);
        }
    }
}