<?php

namespace app\controllers;

use Yii;

class SiteController extends \yii\web\Controller
{
	public function actionIndex()
	{
		return [ 'foo' => 'bar'];
	}
}