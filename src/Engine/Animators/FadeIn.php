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
        $startingOpacity = 0;
        $targetOpacity = 100;

        $speed = $this->calculateSpeed($startingOpacity, $targetOpacity, $animationSettings->getDuration());

        $opacityTracker = 0;
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

        // We handle the last section manually due to the possibility of decimal values
        // in the speed calculation. Animations such a movements and opacity values do not
        // support decimals, due to this we want to always advance towards our target with integer
        // values. When the duration of frames doesn't go into the difference of $startingValue and
        // $endingValue evenly, the calculation will resolve to a decimal value which we convert into
        // and integer by dropping the decimal values. When this is the case, the last frame won't reach
        // the target value, and it'll be off by a few steps; To avoid this, we manually set the target
        // value of the last frame.
        $frame = $this->getOrCreateFrame($lastFrame, $frameBuffer);
        $newClip = $frame->getOrCreateClipByInitialInstance($clip);
        $newOpacity = (new Opacity)->setOpacity($targetOpacity);

        $newClip->addFilter($newOpacity);
    }
}
