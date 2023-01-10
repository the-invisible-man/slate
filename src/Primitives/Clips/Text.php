<?php

namespace TheInvisibleMan\Slate\Primitives\Clips;

use JetBrains\PhpStorm\Pure;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;

class Text extends VideoClip
{
    /**
     * @var int
     */
    protected int $size;

    /**
     * @var int
     */
    protected int $containerWidth;

    /**
     * @var int
     */
    protected int $containerHeight;

    /**
     * @var string
     */
    protected string $align;

    /**
     * @var string
     */
    protected string $font;

    /**
     * @var string
     */
    protected string $text;

    public const ALIGN = [
        'left' => 'left',
        'center' => 'center',
        'right' => 'right',
    ];

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    #[Pure] public function checksum(): string
    {
        return md5(
            's:'.$this->size.
            'w:'.$this->containerWidth.
            'h:'.$this->containerHeight.
            'a:'.$this->align.
            'f:'.$this->font.
            't:'.$this->text.
            'p:'.$this->getPosition()->checksum()
        );
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param int $containerWidth
     * @return $this
     */
    public function setContainerWidth(int $containerWidth): self
    {
        $this->containerWidth = $containerWidth;
        return $this;
    }

    /**
     * @param int $containerHeight
     * @return $this
     */
    public function setContainerHeight(int $containerHeight): self
    {
        $this->containerHeight = $containerHeight;
        return $this;
    }

    /**
     * @param string $align
     * @return $this
     */
    public function setAlign(string $align): self
    {
        $this->align = $align;
        return $this;
    }

    /**
     * @param string $font
     * @return $this
     */
    public function setFont(string $font): self
    {
        $this->font = $font;
        return $this;
    }
}
