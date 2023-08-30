<?php

namespace app\controllers;

use Yii;
use app\models\form\setting\DocumentSettingForm;

class PlanController extends Controller
{
    public function actionCampManagement()
    {
        $file = (new DocumentSettingForm())->getFile('camp_management');

        return $this->render('camp-management', [
            'file' => $file
        ]);
    }

    public function actionLccap()
    {
        $file = (new DocumentSettingForm())->getFile('lccap');
        
        return $this->render('lccap', [
            'file' => $file
        ]);
    }

    public function actionLdrrmp()
    {
        $file = (new DocumentSettingForm())->getFile('ldrrmp');
        
        return $this->render('ldrrmp', [
            'file' => $file
        ]);
    }
}