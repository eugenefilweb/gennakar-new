<?php

namespace tests\unit\models\search;

use app\models\search\ValueLabelSearch;

class ValueLabelSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }

    public function testSearchWithResult()
    {
        $searchModel = new ValueLabelSearch();
        $dataProviders = $searchModel->search(['ValueLabelSearch' => ['keywords' => '']]);
        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(3159);
    }

    public function testSearchWithNoResult()
    {
        $searchModel = new ValueLabelSearch();
        $dataProviders = $searchModel->search([
            'ValueLabelSearch' => ['keywords' => 'qwertyuiopasdfghjkl234567890']
        ]);

        expect_that($dataProviders);
        expect($dataProviders->totalCount)->equals(0);
    }
}