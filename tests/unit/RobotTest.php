<?php
use Codeception\Util\Stub;

require_once 'lib/tabletop.php';
require_once 'lib/robot.php';

class RobotTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy,
              $robot;

    protected function _before()
    {
        $this->robot = new Robot(new Tabletop(5, 5));
    }

    protected function _after()
    {
    }

    // tests
    public function testNew()
    {
        $this->assertInstanceOf('Robot', $this->robot);
    }

    public function testRobotOffTableReport()
    {
        //before place
        $this->assertEquals('', $this->robot->report());

        //invalid places
        $this->robot->place(-1, -1, 'NORTH');
        $this->assertEquals('', $this->robot->report());

        $this->robot->place(-1, 0, 'NORTH');
        $this->assertEquals('', $this->robot->report());

        $this->robot->place(0, -1, 'NORTH');
        $this->assertEquals('', $this->robot->report());

        $this->robot->place(0, 0, 'COWS');
        $this->assertEquals('', $this->robot->report());
    }

    public function testPlaceThenReport()
    {
        //valid place
        $this->robot->place(0, 0, 'NORTH');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        //invalid place
        $this->robot->place(0, 0, 'NORTH');

        $this->robot->place(-1, -1, 'NORTH');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        $this->robot->place(-1, 0, 'NORTH');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        $this->robot->place(0, -1, 'NORTH');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        $this->robot->place(0, 0, 'COWS');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        //more valid places
        $this->robot->place(0, 0, 'NORTH');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        $this->robot->place(1, 1, 'NORTH');
        $this->assertEquals('Output: 1, 1, NORTH', $this->robot->report());

        $this->robot->place(2, 1, 'NORTH');
        $this->assertEquals('Output: 2, 1, NORTH', $this->robot->report());

        $this->robot->place(2, 2, 'NORTH');
        $this->assertEquals('Output: 2, 2, NORTH', $this->robot->report());

        $this->robot->place(2, 2, 'SOUTH');
        $this->assertEquals('Output: 2, 2, SOUTH', $this->robot->report());
    }

    public function testLeft()
    {
        //initial placement of robot
        $this->robot->place(0, 0, 'NORTH');
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());

        $this->robot->left();
        $this->assertEquals('Output: 0, 0, WEST', $this->robot->report());

        $this->robot->left();
        $this->assertEquals('Output: 0, 0, SOUTH', $this->robot->report());

        $this->robot->left();
        $this->assertEquals('Output: 0, 0, EAST', $this->robot->report());

        $this->robot->left();
        $this->assertEquals('Output: 0, 0, NORTH', $this->robot->report());
    }

}