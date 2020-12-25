<?php

namespace app\modules\mymodule\controllers;

class DefaultController extends \yii\web\Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}
}