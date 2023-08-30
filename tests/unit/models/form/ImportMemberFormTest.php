<?php

namespace tests\unit\models\form;

use app\helpers\App;
use app\models\form\ImportHouseholdForm;
use app\models\form\ImportMemberForm;

class ImportMemberFormTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        $model = new ImportHouseholdForm(['file_token' => 'household-OxFBeC2Dzw1624513904-household']);
        $model->save();
    }

    protected function data($replace=[])
    {
        return array_replace([
            'file_token' => 'members-OxFBeC2Dzw1624513904-members',
        ], $replace);
    }

    public function testParse()
    {
        $model = new ImportMemberForm($this->data());

        $data = $model->getData();
        expect(count($data))->equals(1);
        expect(count($data[1]))->equals(4);
    }

    public function testSave()
    {
        $model = new ImportMemberForm($this->data());
        expect_that($model->save());

        $this->tester->seeRecord('app\models\Member', [
            'last_name' => 'DELLOSA',
            'first_name' => 'ERICSON',
            'middle_name' => 'GONSALES',
        ]);

        $this->tester->seeRecord('app\models\Member', [
            'last_name' => 'DELLOSA',
            'first_name' => 'WILMORE',
            'middle_name' => 'GONZALES',
        ]);

        $this->tester->seeRecord('app\models\Member', [
            'last_name' => 'CRUZ',
            'first_name' => 'GILBERT',
            'middle_name' => 'GARCIA',
        ]);
    }

    public function testInvalidExtension()
    {
        $model = new ImportMemberForm([
            'file_token' => 'default-6ccb4a66-0ca3-46c7-88dd-default',
            'scenario' => 'contentValidation'
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('file_token');
    }

    public function testInvalidContentFormat()
    {
        $model = new ImportMemberForm([
            'file_token' => 'invalid-household-OxFBeC2Dzw1624513904-invalid-household',
            'scenario' => 'contentValidation'
        ]);
        expect_not($model->save());
        expect($model->errors)->hasKey('file_token');
    }
}