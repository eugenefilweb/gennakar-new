<?php

namespace tests\unit\models\search;

use app\models\search\EarlyWarningSearch;

class EarlyWarningSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new EarlyWarningSearch();
        $dataProviders = $searchModel->search(['EarlyWarningSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(2);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new EarlyWarningSearch();
        $dataProviders = $searchModel->search([
            'EarlyWarningSearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}