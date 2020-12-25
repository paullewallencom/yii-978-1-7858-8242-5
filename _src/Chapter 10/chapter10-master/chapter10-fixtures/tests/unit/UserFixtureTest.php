<?php

namespace app\tests\unit\UserFixtureTest;

use app\tests\fixtures\UserFixture;
use app\models\User;
use Yii;

class UserFixtureTest extends \yii\codeception\DbTestCase
{
    use \Codeception\Specify;
    
    /**
     * @var \UnitTester
     */
    protected $tester;

    public $appConfig = "@app/tests/config/unit.php";
    
    public function fixtures()
    {
        return [
            'users' => UserFixture::className(),
        ];
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
}