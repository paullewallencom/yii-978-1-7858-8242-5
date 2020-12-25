<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string  $email
 * @property string  $password
 * @property string  $first_name
 * @property string  $last_name
 * @property integer $role_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Post[] $posts
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface, \yii\filters\RateLimitInterface
{
    /**
     * API safe fields
     */
    public function fields()
    {
        return [
            'id',
            'email_address' => 'email',
            'first_name',
            'last_name',
            'full_name' => function($model) {
                return $model->getFullName();
            },
            'updated_at',
            'created_at'
        ];
    }

    public function extraFields()
    {
        return ['role'];
    }

    /**
     * Allow yii to handle population of created_at and updated_at time
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Returns the user's full name
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Set the users first and last name from a single variable
     * @param boolean
     */
    public function setFullName($name)
    {
        list($firstName, $lastName) = explode(" ", $name);
        $this->first_name = $firstName;
        $this->last_name = $lastName;

        return true;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['role_id', 'created_at', 'updated_at'], 'integer'],
            [['email', 'password', 'first_name', 'last_name'], 'string', 'max' => 255],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'email'         => 'Email',
            'password'      => 'Password',
            'first_name'    => 'First Name',
            'last_name'     => 'Last Name',
            'role_id'       => 'Role ID',
            'created_at'    => 'Created At',
            'updated_at'    => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    { 
        return static::findOne($id);
    }

    /** 
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type=null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Handle HTTP basic auth
     * @param string $email
     * @param string $password
     * @return static self
     */
    public function httpBasicAuth($email, $password)
    {
        $model = static::findOne(['email' => $email]);
        if ($model == NULL)
            return NULL;
        
        if (password_verify($password, $model->password))
            return $model;
           
        return NULL;
    }
    
    /**
     * Returns the rate limit
     * @param yii\web\Request $request
     * @param yii\base\Action $action
     * @return array
     */
    public function getRateLimit($request, $action)
    {
        return [100, 600];    
    }
    
    /**
     * Returns the rate limit allowance
     * @param yii\web\Request $request
     * @param yii\base\Action $action
     * @return array
     */
    public function loadAllowance($request, $action)
    { 
        $allowance = 10; // Fetch the allowance from a datasource
        return [$allowance, time()];
    }
    
    /**
     * Saves the rate limit allowance
     * @param yii\web\Request $request
     * @param yii\base\Action $action
     * @param integer $allowance
     * @param interger $timestamp
     * @return array
     */
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        // Update a NoSQL solution or a cache
        return true;
    }
    
    /**
     * @return string current user auth key
     */
    public function getAuthKey() {}

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }
}