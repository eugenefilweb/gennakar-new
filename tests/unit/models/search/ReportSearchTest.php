<?php

namespace tests\unit\models\search;

use app\models\search\ReportSearch;

class ReportSearchTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        \Yii::$app->user->login($this->tester->grabRecord('app\models\User', [
            'username' => 'developer'
        ]));
    }
    
    public function testEmergencyWelfareProgram()
    {
        $searchModel = new ReportSearch();
        $dataProviders = $searchModel->emergency_welfare_program_search(['ReportSearch' => [
            'keywords' => ''
        ]]);

        expect($dataProviders->totalCount)->equals(3);
    }
}