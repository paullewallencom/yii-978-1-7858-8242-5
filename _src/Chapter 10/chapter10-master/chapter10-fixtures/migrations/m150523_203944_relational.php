<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_203944_relational extends Migration
{
    public function safeUp()
    {
		// Users
        $this->createTable('user', [
            'id'           => Schema::TYPE_PK,
            'email'        => Schema::TYPE_STRING . ' NOT NULL',
            'password'     => Schema::TYPE_STRING . ' NOT NULL',
            'first_name'   => Schema::TYPE_STRING,
            'last_name'    => Schema::TYPE_STRING,
			'role_id' 	   => Schema::TYPE_INTEGER . ' DEFAULT 1',
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
			'FOREIGN KEY(role_id) REFERENCES role(id)'
        ]);
        
        $this->createIndex('user_unique_email', 'user', 'email', true);

		// Roles
		$this->createTable('role', [
			'id' 		  => Schema::TYPE_PK,
			'name' 		  => Schema::TYPE_STRING
		]);

		// Posts
		$this->createTable('post', [
			'id' 		  => Schema::TYPE_PK,
			'title'		  => Schema::TYPE_STRING . ' NOT NULL',
			'slug'		  => Schema::TYPE_STRING . ' NOT NULL',
			'content'	  => Schema::TYPE_TEXT . ' NOT NULL',
			'author_id'   => Schema::TYPE_INTEGER,
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
			'FOREIGN KEY(author_id) REFERENCES user(id)'
		]);
		
		$this->batchInsert('role', ['id', 'name'], [
			[1, 'User'], [2, 'Admin']
		]);
    }
    
    public function safeDown()
 	{
		echo "m150523_203944 does not support down migrations\n";
        return false;
    }
}
