<?php

namespace number1;

class Box
{
    private $length;
    private $width;
    private $height;

    function __construct(float $length, float $width, float $height)
    {
        $this->setLength($length);
        $this->setWidth($width);
        $this->setHeight($height);

    }

//Setters

    private function setLength(float $length)
    {
        $this->length = $length;

    }

    private function setWidth(float $width)
    {
        $this->width = $width;

    }

    private function setHeight(float $height)
    {
        $this->height = $height;

    }

    //Getters

    public function getVolume()
    {
        $volume = $this->length * $this->width * $this->height;
        return $volume;
    }

    public function getLateSurfaceArea()
    {
        $leteralSurfaceArea = 2 * ($this->length * $this->height)
            + 2 * ($this->width * $this->height);

        return $leteralSurfaceArea;
    }

    public function getSurfaceArea()
    {
        $surfaceArea = 2 * ($this->length * $this->width) + 2 * ($this->length * $this->height) + 2 * ($this->width * $this->height);
        return $surfaceArea;
    }
}

$length = floatval(trim(fgets(STDIN)));
$width = floatval(trim(fgets(STDIN)));
$height = floatval(trim(fgets(STDIN)));

$box = new Box($length, $width, $height);

echo "Surface Area - " . number_format($box->getSurfaceArea(), 2, '.', '') . PHP_EOL;
echo "Lateral Surface Area - " . number_format($box->getLateSurfaceArea(), 2, '.', '') . PHP_EOL;
echo "Volume - " . number_format($box->getVolume(), 2, '.', '') . PHP_EOL;
