<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Verify login page');

// Verify homepage link works
$I->amOnPage('/');
$I->click('Login');
$I->amOnPage(['site/login']);

// Verify form is present
$I->seeElement('input', ['id' => 'userform-email']);
$I->seeElement('input', ['id' => 'userform-password']);

// Verify bad user/pass fails
$I->fillField(['id' => 'userform-email'], 'foo');
$I->fillField(['id' => 'userform-password'], 'bar');
$I->click("Submit");

$I->SeeCurrentUrlEquals('/site/login');

// Verify bad user/pass fails
$I->fillField(['id' => 'userform-email'], 'admin@example.com');
$I->fillField(['id' => 'userform-password'], 'admin');
$I->click("Submit");

$I->SeeCurrentUrlEquals('/site/index');
