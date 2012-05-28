<?php
App::uses('Pin', 'Model');

/**
 * Pin Test Case
 *
 */
class PinTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.pin', 'app.user', 'app.board', 'app.comment', 'app.like');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pin = ClassRegistry::init('Pin');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pin);

		parent::tearDown();
	}

}
