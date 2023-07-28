<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use Symfony\Component\VarDumper\VarDumper;
use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Primitives\Clips\Filters\Opacity;

class OpacityTween extends Animator
{
    /**
     * @param VideoClip $clip
     * @param int $startingFrame
     * @param array $frameBuffer
     * @param Animation|\TheInvisibleMan\Slate\Primitives\Animations\OpacityTween $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    public function animate(VideoClip $clip, int $startingFrame, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        $startingOpacity = $animationSettings->getStartingValue();
        $targetOpacity = $animationSettings->getTargetValue();

        $speed = $this->calculateSpeed($startingOpacity, $targetOpacity, $animationSettings->getDuration());

        $opacityTracker = $startingOpacity;
        $lastFrame = $startingFrame + $animationSettings->getDuration();

        foreach($this->getOrCreateFrames($startingFrame, $lastFrame - 1, $frameBuffer) as $frame) {
            $newClip = $frame->getOrCreateClipByInitialInstance($clip);
            $newOpacity = (new Opacity)->setOpacity($opacityTracker);

            $newClip->addFilter($newOpacity);
            $opacityTracker += $speed;
        }

        $frame = $this->getOrCreateFrame($lastFrame, $frameBuffer);
        $newClip = $frame->getOrCreateClipByInitialInstance($clip);
        $newOpacity = (new Opacity)->setOpacity($targetOpacity);

        $newClip->addFilter($newOpacity);
    }
}
