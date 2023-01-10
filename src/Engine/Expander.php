<?php

namespace TheInvisibleMan\Slate\Engine;

use TheInvisibleMan\Slate\Engine\Animators\Animator;
use TheInvisibleMan\Slate\Engine\Support\Timeline;
use TheInvisibleMan\Slate\Primitives\Animations\Interfaces\Animation;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
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
     * @return array
     */
    protected function expandSequence(Sequence $sequence, RenderSettings $renderSettings): array
    {
        $frameBuffer = [];

        foreach ($sequence->getVideoClips() as $clip) {
            foreach ($clip->getAnimations() as $animation) {
                $animator = $this->buildAnimator($animation);
                $animator->animate($clip, $frameBuffer, $animation, $renderSettings);
            }
        }

        return $frameBuffer;
    }

    /**
     * @param Animation $animation
     * @return Animator
     */
    protected function buildAnimator(Animation $animation): Animator
    {
        return new $animation->getAnimator();
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
