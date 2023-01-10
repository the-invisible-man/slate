<?php

namespace TheInvisibleMan\Slate\Primitives\Clips\Abstracts;

use TheInvisibleMan\Slate\Exceptions\ClipSettingException;
use TheInvisibleMan\Slate\Primitives\Clips\Interfaces\HasAnimations;
use TheInvisibleMan\Slate\Primitives\Clips\Interfaces\HasFilters;
use TheInvisibleMan\Slate\Primitives\Clips\Interfaces\HasPosition;
use TheInvisibleMan\Slate\Primitives\Clips\Traits\HasAnimationsImpl;
use TheInvisibleMan\Slate\Primitives\Clips\Traits\HasFiltersImpl;
use TheInvisibleMan\Slate\Primitives\Clips\Traits\HasPositionImpl;

abstract class VideoClip extends Clip implements HasAnimations, HasPosition, HasFilters
{
    use HasPositionImpl, HasAnimationsImpl, HasFiltersImpl;

    /**
     * @var string
     */
    protected string $anchorPoint;

    // Anchor points are relative to the bounding box of the video clip
    public const ANCHOR = [
        'center' => 'center',
        'top-left' => 'top-left',
        'bottom-left' => 'bottom-left',
        'top-right' => 'top-right',
        'bottom-right' => 'bottom-right',
    ];

    /**
     * @return string
     */
    abstract public function checksum(): string;

    /**
     * @param string $anchorPoint
     * @return $this
     * @throws ClipSettingException
     */
    public function setAnchorPoint(string $anchorPoint): self
    {
        if (!isset(self::ANCHOR[$anchorPoint])) {
            throw new ClipSettingException("Invalid value for anchor point \"{$anchorPoint}\". Use VideoClip::ANCHOR values only.");
        }

        $this->anchorPoint = $anchorPoint;
        return $this;
    }
}
