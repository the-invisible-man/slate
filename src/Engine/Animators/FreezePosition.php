<?php

namespace TheInvisibleMan\Slate\Engine\Animators;

use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class FreezePosition extends Animator
{
    public function animate(VideoClip $clip, int $startingFrame, array &$frameBuffer, Animation $animationSettings, RenderSettings $renderSettings): void
    {
        // Freeze previous frame, or current clip if no previous frame exists
        $lastFrame = $this->getPreviousFrame($startingFrame, $frameBuffer);
        $frozenClip = $clip;

        if ($lastFrame) {
            // The last frame in the buffer might or might not contain this clip.
            $clipFromPreviousFrame = $lastFrame->getClipByInitialInstance($clip);

            // If clip is found in previous frame, use that instance to create freeze frames.
            if ($clipFromPreviousFrame) {
                $frozenClip = $clipFromPreviousFrame;
            }
        }

        foreach ($this->getOrCreateFrames($startingFrame, $startingFrame + $animationSettings->getDuration() - 1, $frameBuffer) as $frame) {
            // We don't need to do anything here because the object was cloned with its current position
            // in place. We just need the frames to created into the buffer.
            $frame->getOrCreateClipByInitialInstance($frozenClip);
        }
    }
}
