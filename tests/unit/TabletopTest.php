<?php
use Codeception\Util\Stub;

require 'lib/tabletop.php';

class TabletopTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy,
              $tabletop;

    protected function _before()
    {
        $this->tabletop = new Tabletop(5, 5);
    }

    protected function _after()
    {
    }

    // tests
    public function testNew()
    {
        $this->assertInstanceOf('Tabletop', $this->tabletop);
    }

    public function testGetXMax()
    {
        $this->assertEquals(5, $this->tabletop->getXMax());
    }

    public function testGetYMax()
    {
        $this->assertEquals(5, $this->tabletop->getYMax());
    }

    public function testGetSquare()
    {
        $this->assertInstanceOf('Square', $this->tabletop->getSquare(2, 3));
    }
}