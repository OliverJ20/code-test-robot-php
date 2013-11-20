<?php

class Tabletop
{
    private $tabletop = NULL;

    public function __construct($xMax = 1, $yMax = 1)
    {
        $this->tabletop = array_fill(0, $xMax, array_fill(0, $yMax, new Square));
    }

    public function getXMax()
    {
        return sizeof($this->tabletop);
    }

    public function getYMax()
    {
        return sizeof($this->tabletop[0]);
    }

    public function getSquare($x, $y)
    {
        if($this->isValidXY($x, $y))
            return $this->tabletop[$x][$y];
        else
            return NULL;
    }

    public function isValidXY($x, $y)
    {
        if( is_int($x) && is_int($y) &&
            $x >= 0 && $y >= 0 &&
            $x < $this->getXMax() && $y < $this->getYMax())
            return true;
        else
            return false;
    }
}