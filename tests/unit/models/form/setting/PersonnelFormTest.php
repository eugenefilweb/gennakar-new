<?php

namespace tests\unit\models\form\setting;

use app\models\form\setting\PersonnelForm;

class PersonnelFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new PersonnelForm();

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Setting', [
            'name' => $model::NAME
        ]);
    }

    public function testMswdoRequired()
    {
        $model = new PersonnelForm();
        $model->mswdo = '';
        expect_not($model->save());
        expect($model->errors)->hasKey('mswdo');
    }

    public function testMayorRequired()
    {
        $model = new PersonnelForm();
        $model->mayor = '';
        expect_not($model->save());
        expect($model->errors)->hasKey('mayor');
    }
}