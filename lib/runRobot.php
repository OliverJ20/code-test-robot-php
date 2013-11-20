<?php

require_once 'robot.php';
require_once 'tabletop.php';
require_once 'square.php';
require_once 'commandParser.php';

class RunRobot
{
    private $robot = null;

    public function __construct($argv)
    {
        $this->robot = new Robot(new Tabletop(5, 5));

        for ($i = 1; $i < sizeof($argv); $i++) {
            $this->runFile($argv[$i]);
        }
    }

    private function runFile($filename)
    {
        $commandParser = new CommandParser($filename);
        $commands = $commandParser->getCommands();

        if ($commands !== null) {
            print('*** ' . $filename . " ***\n");

            foreach ($commands as $command) {
                if ($command == 'MOVE') {
                    $this->robot->move();
                } elseif ($command == 'LEFT') {
                    $this->robot->left();
                } elseif ($command == 'RIGHT') {
                    $this->robot->right();
                } elseif ($command == 'REPORT') {
                    print($this->robot->report() . "\n");
                } else {
                    $placeArgs = preg_split("/[\s,]+/", $command);
                    $this->robot->place(
                        intval($placeArgs[1]),
                        intval($placeArgs[2]),
                        $placeArgs[3]
                    );
                }
            }

            print('*** End of ' . $filename . " ***\n\n");
        }
    }
}