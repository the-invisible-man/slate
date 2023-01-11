<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class FreezePosition extends Animator
{
    public function animate(VideoClip $clip, int $startingFrame, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        // Freeze given the current clip or last frame
        $lastFrame = $startingFrame > 0 ? $this->getOrCreateFrame($startingFrame - 1, $frameBuffer) : null;
        $initialStateClip = $clip;

        if ($lastFrame) {
            $existingClip = $lastFrame->getClipByInitialInstance($clip);
            if ($existingClip) {
                $initialStateClip = $existingClip;
            }
        }

        foreach ($this->getOrCreateFrames($startingFrame, $startingFrame + $animationSettings->getDuration() - 1, $frameBuffer) as $frame) {
            // We don't need to do anything here because the object was cloned with its current position
            // in place. We just need the frames to created into the buffer.
            $frame->getOrCreateClipByInitialInstance($initialStateClip);
        }
    }
}
