<?php

use TheInvisibleMan\Slate\Primitives\Sequence;
use TheInvisibleMan\Slate\Primitives\Coordinate;
use TheInvisibleMan\Slate\Primitives\Clips\Text;
use TheInvisibleMan\Slate\Primitives\Clips\Image;
use TheInvisibleMan\Slate\Primitives\Clips\Rectangle;
use TheInvisibleMan\Slate\Primitives\Animations\FadeIn;
use TheInvisibleMan\Slate\Primitives\Animations\FadeOut;
use TheInvisibleMan\Slate\Primitives\Animations\Compound;
use TheInvisibleMan\Slate\Primitives\Animations\Freeze;
use TheInvisibleMan\Slate\Primitives\Animations\Motion;
use TheInvisibleMan\Slate\Primitives\Composition;
use TheInvisibleMan\Slate\Engine\RenderSettings;
use TheInvisibleMan\Slate\Primitives\Clips\Abstracts\VideoClip;
use TheInvisibleMan\Slate\Engine\Expander;

require_once './vendor/autoload.php';

/**
 * Slate: A PHP library generating audiovisual content
 */

// Create a new sequence to hold all our stuff
$sequence = new Sequence;
$sequence->setHeight(720)
    ->setWidth(1280)
    ->setBackground('#fff');

$textInitialPosition = $sequence->center()->addY(-300);

// This is the text we want to show
// We'll wrap it inside a container so that it stays within its box
$text = new Text('This is a test of text that not only displays but also wraps');
$text->setSize(20)
    ->setContainerWidth(300)
    ->setContainerHeight(300)
    ->setAnchorPoint(VideoClip::ANCHOR['center'])
    ->setPosition($textInitialPosition)
    ->setAlign(Text::ALIGN['center'])
    ->setFont('Helvetica');

// Image watermark
$watermark = new Image('watermark.jpg');
$watermark->setPosition(new Coordinate(100, 100));

// We want a rectangle to be the background.
// We'll make it larger than the text's bounding box
$textBackground = new Rectangle(400, 400);
$textBackground->setPosition($textInitialPosition);

// Build animations for the text
$fadeIn = new FadeIn;
$fadeIn->setDuration(6);

$freeze = new Freeze;
$freeze->setDuration(2);

$fadeOut = new FadeOut;
$fadeOut->setDuration(6);

// Position animations simply override the objects
// relative in the stage position
$moveToTarget = $textInitialPosition->addY(300);
$moveIn = new Motion;
$moveIn->setDuration(6)
    ->setTargetPosition($moveToTarget);

$moveOut = new Motion;
$moveOut->setDuration(6)
    ->setTargetPosition($moveToTarget->addY(600));

// Compounds allow us to mix two effects into
// the same animation. Here we're joining the fade with the
// position editor to create a sweep in and out effect on the text.
// Compound animations should have the same duration
$textEnterTween = new Compound;
$textEnterTween->add($moveIn)
    ->add($fadeIn);

$textExitTween = new Compound;
$textExitTween->add($moveOut)
    ->add($fadeOut);

// Animate object
$text->addAnimation($textEnterTween)
    ->addAnimation($freeze)
    ->addAnimation($textExitTween);

// We want the rectangle to stay in view the whole time so
// just make it last the same as the text layer
$stillFrame = new Freeze;
$stillFrame->setDuration($text->getDuration());

$textBackground->addAnimation($stillFrame);

// Animation objects can be reused
$watermark->addAnimation($stillFrame);

// Layers are stacked in the order in which they are added into the sequence
//$sequence->layerVideoClip($textBackground); // Bottom layer
$sequence->layerVideoClip($text);           // Middle layer
//$sequence->layerVideoClip($watermark);      // Top layer

// Drop one or more sequences into the timeline
$comp = new Composition;
$comp->append($sequence);

$expander = new Expander;
$settings = new RenderSettings;

$settings->frameRate = 24;
$settings->exportPath = '/Users/cgranados/output.mp4';
$settings->workingDirectory = '/Users/cgranados/slate-working-dir';

$timeline = $expander->expand($comp, $settings);

$frameCount = 0 ;

foreach ($timeline->getFrames() as $frame) {
    echo "\nFrame {$frameCount}";
    $frameCount++;

    foreach ($frame->getLayers() as $objectId => $clip) {
        echo "\nObject {$objectId}. Type: ".get_class($clip);
        echo "\nPosition {$clip->getPosition()->getX()}";
        echo "\nPosition {$clip->getPosition()->getY()}";

        foreach ($clip->getFilters() as $filter) {
            echo "\nFilter type: ".get_class($filter);
            \Symfony\Component\VarDumper\VarDumper::dump($filter->serialize());
        }
    }
    echo "\n--------------------------------------------------";
}
