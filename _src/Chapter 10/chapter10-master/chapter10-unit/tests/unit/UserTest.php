<?php

namespace app\tests\unit\UserTest;

use Codeception\TestCase\Test;

use app\models\User;
use yii\codeception\TestCase;
use Yii;

class UserTest extends Test
{
	use \Codeception\Specify;

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

	/**
 	 * Test that app\models\User::setFullName() __setter sets both first_name and last_name
	 */
    public function testSetFullName()
    {
		$user = new User;
		$user->setFullName('John Doe');

		// Asser the setFullName method works
		$this->assertTrue($user->first_name == "John");
		$this->assertTrue($user->last_name == "Doe");
		$this->assertFalse($user->first_name == "Jane");
		unset($user);

		$user = new User;
		$user->fullName = 'John Doe';
		
		// Asser the setFullName method works
		$this->assertTrue($user->first_name == "John");
		$this->assertTrue($user->last_name == "Doe");
		$this->assertFalse($user->first_name == "Jane");

		unset($user);
    }

	/**
 	 * Tests that app\models\User::validatePassword correctly validates the password
	 */
	public function testValidatePassword()
	{
		$user = User::find()->where(['id' => 1])->one();
		$this->assertTrue($user->validatePassword('password1'));
		$this->assertFalse($user->validatePassword('password2'));
		unset($user);

		$user = User::find()->where(['id' => 2])->one();
		$this->assertTrue($user->validatePassword('password2'));
		$this->assertFalse($user->validatePassword('password1'));
		unset($user);

		$user = User::find()->where(['id' => 3])->one();
		$this->assertTrue($user->validatePassword('password3'));
		$this->assertFalse($user->validatePassword('password4'));
		unset($user);

		$user = User::find()->where(['id' => 4])->one();
		$this->assertTrue($user->validatePassword('admin'));
		$this->assertFalse($user->validatePassword('notadmin'));
		unset($user);
	}
	
	
	/**
 	 * Tests our validators
	 */
	public function testValidate()
	{
		$this->specify('email and password are required', function() {
			$user = new User;
			$this->assertFalse($user->validate());

			// Verify that the email and password properties are required
			$this->assertTrue($user->hasErrors('email'));
			$this->assertTrue($user->hasErrors('password'));
			$user->email = 'user@example.com';
			$user->password =  password_hash('example', PASSWORD_BCRYPT, ['cost' => 13]);
			$this->assertTrue($user->validate());
		});

		$this->specify('email is unique', function() {
			$user = new User;
			// Verify email is unique
			$user->email = 'jane.doe@example.com';
			$user->password =  password_hash('example', PASSWORD_BCRYPT, ['cost' => 13]);
			$this->assertFalse($user->validate());
			$this->assertTrue($user->hasErrors('email'));
		});

		$this->specify('first and last name are strings', function() {
			$user = new User;
			$user->email = 'user@example.com';
			$user->password =  password_hash('example', PASSWORD_BCRYPT, ['cost' => 13]);
			// Verify first and last name has to be strings
			$user->first_name = (int)7;
			$user->last_name = (int)5;

			$this->assertFalse($user->validate());
			$this->assertTrue($user->hasErrors('first_name'));
			$this->assertTrue($user->hasErrors('last_name'));

			// Verify that strings work
			$user->setFullName('Example User');
			$this->assertTrue($user->validate());
		});
	}
}
