<?php
App::uses('Like', 'Model');

/**
 * Like Test Case
 *
 */
class LikeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.like', 'app.user', 'app.pin', 'app.board');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Like = ClassRegistry::init('Like');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Like);

		parent::tearDown();
	}

}
