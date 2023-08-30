<?php

namespace tests\unit\models\search;

use app\models\search\MunicipalitySearch;

class MunicipalitySearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new MunicipalitySearch();
        $dataProviders = $searchModel->search(['MunicipalitySearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(3);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new MunicipalitySearch();
        $dataProviders = $searchModel->search([
            'MunicipalitySearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}