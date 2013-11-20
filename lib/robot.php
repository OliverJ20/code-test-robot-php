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
        if($this->hasBeenPlaced())
        {
            return 'Output: ' . $this->location['x'] . ', ' . $this->location['y'] . ', ' . $this->compass[$this->aspect];
        }
        else
        {
            return '';
        }
    }

    public function place($x, $y, $aspectInString)
    {
        $tmpAspect = array_search($aspectInString, $this->compass);

        if($this->tabletop->isValidXY($x, $y) && $tmpAspect !== FALSE)
        {
            $this->location['x'] = $x;
            $this->location['y'] = $y;

            $this->aspect = $tmpAspect;
        }
        else
            return;
    }

    public function left()
    {
        if(!$this->hasBeenPlaced())
        {
            return;
        }
        elseif($this->tabletop->isValidXY($this->location['x'], $this->location['y'], $this->compass[$this->aspect]))
        {
            $this->aspect -= 1;

            if($this->aspect < 0)
                $this->aspect = 3;
        }
        else
            return;
    }

    public function right()
    {
        if(!$this->hasBeenPlaced())
        {
            return;
        }
        elseif($this->tabletop->isValidXY($this->location['x'], $this->location['y'], $this->compass[$this->aspect]))
        {
            $this->aspect += 1;

            if($this->aspect >= sizeof($this->compass))
                $this->aspect = 0;
        }
        else
            return;    
    }

    private function hasBeenPlaced()
    {
        if($this->location['x'] === NULL || $this->location['y'] === NULL || $this->aspect === NULL)
            return FALSE;
        else
            return TRUE;
    }
}