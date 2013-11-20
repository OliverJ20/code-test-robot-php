<?php
use Codeception\Util\Stub;

require 'lib/tabletop.php';

class TabletopTest extends \Codeception\TestCase\Test
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
        $this->assertInstanceOf('Tabletop', new Tabletop(5, 5));
    }

    public function testGetXMax()
    {
        $tabletop = new Tabletop(5, 5);
        $this->assertEquals(5, $tabletop->getXMax());
    }

    public function testGetYMax()
    {
        $tabletop = new Tabletop(5, 5);
        $this->assertEquals(5, $tabletop->getYMax());
    }
}