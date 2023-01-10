<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class Compound extends Animator
{
    /**
     * @param VideoClip $clip
     * @param array $frameBuffer
     * @param Animation|\TheInvisibleMan\Slate\Primitives\Animations\Compound $animationSettings
     * @param RenderSettings $renderSettings
     * @return void
     */
    public function animate(VideoClip $clip, int $startingFrame, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        foreach ($animationSettings->getAnimations() as $animation) {
            $animator = $animation->getAnimator();
            $animator->animate($clip, $startingFrame, $frameBuffer, $animation, $renderSettings);
        }
    }
}
