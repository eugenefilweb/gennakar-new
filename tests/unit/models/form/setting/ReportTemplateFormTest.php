<?php

namespace tests\unit\models\form\setting;

use app\models\form\setting\ReportTemplateForm;

class ReportTemplateFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new ReportTemplateForm();

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Setting', [
            'name' => $model::NAME
        ]);
    }

    public function testCertificateOfIndigencyRequired()
    {
        $model = new ReportTemplateForm();
        $model->certificate_of_indigency = '';
        expect_not($model->save());
        expect($model->errors)->hasKey('certificate_of_indigency');
    }
}