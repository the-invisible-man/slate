<?php

namespace Slate\Primitives\Clips\Abstracts;

use Slate\Exceptions\ClipSettingException;

abstract class VideoClip extends Clip
{
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
