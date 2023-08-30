<?php

namespace tests\unit\models\search;

use app\models\search\AmbulanceDispatchReportSearch;

class AmbulanceDispatchReportSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new AmbulanceDispatchReportSearch();
        $dataProviders = $searchModel->search(['AmbulanceDispatchReportSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(2);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new AmbulanceDispatchReportSearch();
        $dataProviders = $searchModel->search([
            'AmbulanceDispatchReportSearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}