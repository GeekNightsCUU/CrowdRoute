<?php
class TrueTest extends PHPUnit_Framework_TestCase
{
	public function testSuccess() {
		$this->assertTrue(TRUE);
	}

	public function testFailure() {
		$this->assertTrue(FALSE);
	}
}