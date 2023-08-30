<?php

namespace tests\unit\models\search;

use app\models\search\BarangaySearch;

class BarangaySearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new BarangaySearch();
        $dataProviders = $searchModel->search(['BarangaySearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(17);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new BarangaySearch();
        $dataProviders = $searchModel->search([
            'BarangaySearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}