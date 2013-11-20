<?php

class Square
{
    //To allow for overloading to support different square sets.
    //eg. TreeSquare extends Square, robot cannot be where the tree is.
    public function robotCanOccupy()
    {
        return true;
    }
}