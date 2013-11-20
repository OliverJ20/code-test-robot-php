<?php

class Robot
{
    private $tabletop = null,
            $aspect = null,
            $location = null,
            $compass = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    public function __construct($tabletop)
    {
        $this->tabletop = $tabletop;

        $this->location = [
            'x' => null,
            'y' => null
        ];
    }

    public function report()
    {
        if ($this->hasBeenPlaced()) {
            $output = 'Output: '
                    . $this->location['x'] . ', '
                    . $this->location['y'] . ', '
                    . $this->compass[$this->aspect];

            return $output;
        } else {
            return '';
        }
    }

    public function place($x, $y, $aspectInString)
    {
        $tmpAspectIndex = array_search($aspectInString, $this->compass);

        if ($this->tabletop->isValidXY($x, $y) && $tmpAspectIndex !== false) {
            $this->location['x'] = $x;
            $this->location['y'] = $y;

            $this->aspect = $tmpAspectIndex;
        } else {
            return;
        }
    }

    public function left()
    {
        if (!$this->hasBeenPlaced()) {
            return;
        } elseif ($this->tabletop->isValidXY(
            $this->location['x'],
            $this->location['y'],
            $this->compass[$this->aspect])
        ){
            $this->aspect -= 1;

            if ($this->aspect < 0) {
                $this->aspect = 3;
            }
        } else {
            return;
        }
    }

    public function right()
    {
        if (!$this->hasBeenPlaced()) {
            return;
        } elseif ($this->tabletop->isValidXY(
            $this->location['x'],
            $this->location['y'],
            $this->compass[$this->aspect])
        ){
            $this->aspect += 1;

            if ($this->aspect >= sizeof($this->compass)) {
                $this->aspect = 0;
            }
        } else {
            return;
        }
    }

    public function move()
    {
        if (!$this->hasBeenPlaced()) {
            return;
        }

        if ($this->aspect == array_search('NORTH', $this->compass)) {
            $newLocation = $this->getNewLocation(0, 1);

            $square =   $this->tabletop->getSquare(
                            $newLocation['x'],
                            $newLocation['y']
                        );

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } elseif ($this->aspect == array_search('EAST', $this->compass)) {
            $newLocation = $this->getNewLocation(1, 0);

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } elseif ($this->aspect == array_search('SOUTH', $this->compass)) {
            $newLocation = $this->getNewLocation(0, -1);

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } elseif ($this->aspect == array_search('WEST', $this->compass)) {
            $newLocation = $this->getNewLocation(-1, 0);

            if ($this->isValidSquare($newLocation)) {
                $this->location = $newLocation;
            } else {
                return;
            }
        } else {
            return;
        }
    }

    private function hasBeenPlaced()
    {
        $anyNull =  $this->location['x'] === null ||
                    $this->location['y'] === null ||
                    $this->aspect === null;

        if ($anyNull) {
            return false;
        } else {
            return true;
        }
    }

    private function getNewLocation($xOffset, $yOffset)
    {
        $newLocation = [
            'x' => $this->location['x'] + $xOffset,
            'y' => $this->location['y'] + $yOffset
        ];

        return $newLocation;
    }

    private function isValidSquare($newLocation)
    {
        $square =   $this->tabletop->getSquare(
                        $newLocation['x'],
                        $newLocation['y']
                    );

        if ($square !== null) {
            return true;
        } else {
            return false;
        }
    }
}