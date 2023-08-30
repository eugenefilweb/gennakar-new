<?php

namespace tests\unit\models\form;

use app\helpers\App;
use app\models\Budget;
use app\models\Transaction;
use app\models\form\AddBudgetForm;

class AddBudgetFormTest extends \Codeception\Test\Unit
{
    private function data($replace=[])
    {
        return array_replace([
            'budget' => 2000,
            'remarks' => 'remarks',
        ], $replace);
    }

    public function testSuccess()
    {
        $model = new AddBudgetForm($this->data());
        expect_that($model->save());

        $currentYear = date('Y', strtotime(App::formatter()->asDateToTimezone()));

        $this->tester->seeRecord('app\models\Budget', [
            'budget' => 2000,
            'remarks' => 'remarks',
            'type' => Transaction::EMERGENCY_WELFARE_PROGRAM,
            'action' => Budget::ADD,
            'year' => $currentYear
        ]);
    }

    public function testYearInvalid()
    {
        $model = new AddBudgetForm($this->data());
        $model->year = 9999999;
        expect_not($model->save());
        expect($model->errors)->hasKey('year');


        $model = new AddBudgetForm($this->data());
        $model->year = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('year');
    }

    public function testBudgetInvalid()
    {
        $model = new AddBudgetForm($this->data());
        $model->budget = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('budget');
    }

    public function testUpdateBudget()
    {
        $model = new AddBudgetForm($this->data());
        expect_that($model->save());

        $budget = $this->tester->grabRecord('app\models\Budget', [
            'budget' => 2000,
            'remarks' => 'remarks',
            'type' => Transaction::EMERGENCY_WELFARE_PROGRAM,
            'action' => Budget::ADD,
        ]);

        $newModel = new AddBudgetForm([
            'budget_id' => $budget->id,
            'scenario' => 'update' 
        ]);

        $newModel->budget = 500;
        expect_that($newModel->save());

        $this->tester->seeRecord('app\models\Budget', [
            'budget' => 500,
            'remarks' => 'remarks',
            'type' => Transaction::EMERGENCY_WELFARE_PROGRAM,
            'action' => Budget::ADD,
        ]);
    }


    public function testBudgetIdUpdate()
    {
        $model = new AddBudgetForm($this->data());
        expect_that($model->save());

        $budget = $this->tester->grabRecord('app\models\Budget', [
            'budget' => 2000,
            'remarks' => 'remarks',
            'type' => Transaction::EMERGENCY_WELFARE_PROGRAM,
            'action' => Budget::ADD,
        ]);

        $newModel = new AddBudgetForm([
            'scenario' => 'update' 
        ]);
        expect_not($newModel->validate('budget_id'));

        $newModel->budget_id = 9999;
        expect_not($newModel->validate('budget_id'));
    }
}