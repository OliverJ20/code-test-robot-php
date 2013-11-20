<?php

class CommandParser
{
    private $commandsArray = null;

    public function __construct($filename)
    {
        if (is_file($filename) && is_readable($filename)) {
            $this->commandsArray = explode(PHP_EOL, file_get_contents($filename));
        } else {
            return;
        }

        foreach ($this->commandsArray as &$newCommand) {
            if (!($this->isMoveCommand($newCommand) ||
                $this->isLeftCommand($newCommand) ||
                $this->isRightCommand($newCommand) ||
                $this->isReportCommand($newCommand) ||
                $this->isPlaceCommand($newCommand))
            ){
                $this->commandsArray = null;
                break;
            }
        }
    }

    public function getCommands()
    {
        return $this->commandsArray;
    }

    private function isMoveCommand($currentLine)
    {
        $pattern = '/^MOVE$/';
        
        return $this->evaluatePattern($pattern, $currentLine);
    }

    private function isLeftCommand($currentLine)
    {
        $pattern = '/^LEFT$/';

        return $this->evaluatePattern($pattern, $currentLine);
    }

    private function isRightCommand($currentLine)
    {
        $pattern = '/^RIGHT$/';

        return $this->evaluatePattern($pattern, $currentLine);
    }

    private function isReportCommand($currentLine)
    {
        $pattern = '/^REPORT$/';

        return $this->evaluatePattern($pattern, $currentLine);
    }

    private function isPlaceCommand($currentLine)
    {
        $pattern = '/^PLACE [0-9]+, [0-9]+, (?:NORTH|EAST|SOUTH|WEST)$/';

        return $this->evaluatePattern($pattern, $currentLine);
    }

    private function evaluatePattern($pattern, $currentLine)
    {
        $result = preg_match($pattern, $currentLine);

        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }
}