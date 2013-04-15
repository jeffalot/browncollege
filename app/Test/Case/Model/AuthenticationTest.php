<?php
App::uses('Authentication', 'Model');

/**
 * Authentication Test Case
 *
 */
class AuthenticationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.authentication'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Authentication = ClassRegistry::init('Authentication');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Authentication);

		parent::tearDown();
	}

}
