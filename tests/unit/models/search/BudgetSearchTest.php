<?php

namespace tests\unit\models\search;

use app\models\search\BudgetSearch;

class BudgetSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new BudgetSearch();
        $dataProviders = $searchModel->search(['BudgetSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(4);
    }

    public function testSearchWithResultCurrentYear()
    {
        $searchModel = new BudgetSearch();
        $searchModel->setToCurrentYear();
        $dataProviders = $searchModel->search(['BudgetSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(1);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new BudgetSearch();
        $dataProviders = $searchModel->search([
            'BudgetSearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}