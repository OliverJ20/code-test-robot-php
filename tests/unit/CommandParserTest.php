<?php
use Codeception\Util\Stub;

require_once 'lib/commandParser.php';

class CommandParserTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testNew()
    {
        //test each command
        //test move
        $commandParser = new CommandParser('testdata/movefile');
        $this->assertEquals(['MOVE'], $commandParser->getCommands());

        //test left
        $commandParser = new CommandParser('testdata/leftfile');
        $this->assertEquals(['LEFT'], $commandParser->getCommands());

        //test right
        $commandParser = new CommandParser('testdata/rightfile');
        $this->assertEquals(['RIGHT'], $commandParser->getCommands());

        //test report
        $commandParser = new CommandParser('testdata/reportfile');
        $this->assertEquals(['REPORT'], $commandParser->getCommands());

        //test place
        $commandParser = new CommandParser('testdata/placefile');
        $this->assertEquals(['PLACE 0, 0, NORTH'], $commandParser->getCommands());

        //test file with mixed commands
        $commandParser = new CommandParser('testdata/testfile1');
        $this->assertEquals([
            'MOVE',
            'LEFT',
            'RIGHT',
            'REPORT',
            'PLACE 0, 0, NORTH'
        ], $commandParser->getCommands());

        //file with errors
        $commandParser = new CommandParser('testdata/testfile2');
        $this->assertInstanceOf('CommandParser', $commandParser);
        $this->assertNull($commandParser->getCommands());
    }
}