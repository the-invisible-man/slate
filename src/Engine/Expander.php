<?php

namespace TheInvisibleMan\Slate\Engine;

use TheInvisibleMan\Slate\Engine\Support\Frame;
use TheInvisibleMan\Slate\Engine\Support\Timeline;
use TheInvisibleMan\Slate\Primitives\Composition;
use TheInvisibleMan\Slate\Primitives\Sequence;

class Expander
{
    /**
     * The Expander's job is to convert the sequences of a composition into a timeline
     * comprising frames that include all relevant information regarding the state of the
     * clips in view. The Timeline object returned can be passed along to the render driver
     * to convert the frame data into image files.
     *
     * @param Composition $composition
     * @param RenderSettings $renderSettings
     * @return Timeline
     */
    public function expand(Composition $composition, RenderSettings $renderSettings): Timeline
    {
        $this->validate($composition);

        $timeline = new Timeline;

        foreach ($composition->getSequences() as $sequence) {
            $timeline->appendFrames($this->expandSequence($sequence, $renderSettings));
        }

        return $timeline;
    }

    /**
     * @param Sequence $sequence
     * @param RenderSettings $renderSettings
     * @return Frame[]
     */
    protected function expandSequence(Sequence $sequence, RenderSettings $renderSettings): array
    {
        $frameBuffer = [];
        $startingFrame = 0;

        foreach ($sequence->getVideoClips() as $clip) {
            foreach ($clip->getAnimations() as $animation) {
                $animation->getAnimator()->animate($clip, $startingFrame, $frameBuffer, $animation, $renderSettings);
                $startingFrame += $animation->getDuration() + 1;
            }
        }

        return $frameBuffer;
    }

    /**
     *
     * @param Composition $composition
     * @return void
     */
    protected function validate(Composition $composition): void
    {

    }
}
