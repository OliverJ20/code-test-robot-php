<?php

class Robot
{
    private $tabletop = NULL,
            $aspect = NULL,
            $location = NULL,
            $compass = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    public function __construct($tabletop)
    {
        $this->tabletop = $tabletop;

        $this->location = [
            'x' => NULL,
            'y' => NULL
        ];
    }

    public function report()
    {
        if( $this->location['x'] === NULL || $this->location['y'] === NULL || $this->aspect === NULL)
        {
            return '';
        }
        else
        {
            return 'Output: ' . $this->location['x'] . ', ' . $this->location['y'] . ', ' . $this->compass[$this->aspect];
        }
    }

    public function place($x, $y, $aspectInString)
    {
        $tmpAspect = array_search($aspectInString, $this->compass);

        if($this->tabletop->isValidXY($x, $y) &&  $tmpAspect !== false)
        {
            $this->location['x'] = $x;
            $this->location['y'] = $y;

            $this->aspect = $tmpAspect;
        }
        else
            return;
    }

    
}