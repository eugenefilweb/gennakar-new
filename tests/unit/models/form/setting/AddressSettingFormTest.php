<?php

namespace tests\unit\models\form\setting;

use app\models\form\setting\AddressSettingForm;


class AddressSettingFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new AddressSettingForm();

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Setting', [
            'name' => $model::NAME
        ]);
    }

    public function testRegionIdInvalid()
    {
        $model = new AddressSettingForm();
        $model->region_id = 99999;
        expect_not($model->save());
        expect($model->errors)->hasKey('region_id');
    }

    public function testProvinceIdInvalid()
    {
        $model = new AddressSettingForm();
        $model->province_id = 99999;
        expect_not($model->save());
        expect($model->errors)->hasKey('province_id');
    }

    public function testMunicipalityIdInvalid()
    {
        $model = new AddressSettingForm();
        $model->municipality_id = 99999;
        expect_not($model->save());
        expect($model->errors)->hasKey('municipality_id');
    }
}