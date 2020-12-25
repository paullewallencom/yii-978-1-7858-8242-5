<?php

use yii\db\Schema;
use yii\db\Migration;

class m150919_170520_auth_token extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'access_token', 'string');
    }

    public function safeDown()
    {
        echo "m150919_170520_auth_token cannot be reverted.\n";

        return false;
    }
}
