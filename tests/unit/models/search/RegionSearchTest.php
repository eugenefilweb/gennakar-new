<?php

namespace tests\unit\models\search;

use app\models\search\RegionSearch;

class RegionSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new RegionSearch();
        $dataProviders = $searchModel->search(['RegionSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(3);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new RegionSearch();
        $dataProviders = $searchModel->search([
            'RegionSearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}