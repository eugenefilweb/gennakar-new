<?php

namespace tests\unit\models\search;

use app\models\search\LocalGovernmentUnitSearch;

class LocalGovernmentUnitSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new LocalGovernmentUnitSearch();
        $dataProviders = $searchModel->search(['LocalGovernmentUnitSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(2);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new LocalGovernmentUnitSearch();
        $dataProviders = $searchModel->search([
            'LocalGovernmentUnitSearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}