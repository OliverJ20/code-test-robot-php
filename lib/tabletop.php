<?php

class Tabletop
{
    private $xMax = null,
            $yMax = null,
            $tabletop = null;

    public function __construct($xMax = 1, $yMax = 1)
    {
        $this->xMax = $xMax;
        $this->yMax = $yMax;

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
}