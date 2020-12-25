<?php

namespace app\modules\mymodule;

class Module extends \yii\base\Module
{
	public $layout = 'main';
	
	public $foo;
	
	public function init()
	{
		parent::init();
	}
}
