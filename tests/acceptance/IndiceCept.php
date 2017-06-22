<?php
$I = new AcceptanceTester($scenario);
$I->am("abiezer");
$I->wantTo("see content");

$I->amOnPage("/");
$I->see("evavenezuela","#texto > h2");
$I->click("Acceder","a");
$I->see("ACCEDER","#login-form-popup > div > div.account-container.lightbox-inner > div > h3");
$I->fillField("#username");
