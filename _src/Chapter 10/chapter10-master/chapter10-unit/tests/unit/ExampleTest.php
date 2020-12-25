<?php


class ExampleTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testMe()
    {
		$this->assertTrue(true);
    }

	public function testMeToo()
    {
		$this->assertFalse(false);
	}
}
