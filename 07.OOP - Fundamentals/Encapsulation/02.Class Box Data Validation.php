<?php
declare(strict_types = 1);
namespace number2;


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
        $this->exception($length,$width,$height);
    }


    private function exception(float $length, float $width, float $height)
    {
        if ($length <= 0) {
            throw new \Exception("Length cannot be zero or negative.");

        }
        if ($width <= 0) {
            throw new \Exception("Width cannot be zero or negative.");

        }
        if ($height <= 0) {
            throw new \Exception("Height cannot be zero or negative.");

        }
    }


//Setters

    private function setLength(float &$length)
    {
        $this->length = $length;

    }

    private function setWidth(float &$width)
    {
        $this->width = $width;

    }

    private function setHeight(float &$height)
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


//$length = 0;
//$width = 1;
//$height = 2;


try {
    $box = new Box($length, $width, $height);
    echo "Surface Area - " . number_format($box->getSurfaceArea(), 2, '.', '') . PHP_EOL;
    echo "Lateral Surface Area - " . number_format($box->getLateSurfaceArea(), 2, '.', '') . PHP_EOL;
    echo "Volume - " . number_format($box->getVolume(), 2, '.', '') . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage();
}



