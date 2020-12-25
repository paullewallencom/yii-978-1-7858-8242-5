<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Verify that homepage loads');
$I->amOnPage('/');
$I->amOnPage('site/index');
$I->see('Now you\'re thinking with widgets!');
$I->see('Home');
$I->see('Login');
$I->see('Register');