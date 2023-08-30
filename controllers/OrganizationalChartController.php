<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\form\setting\DocumentSettingForm;
use app\models\form\setting\SystemSettingForm;

class OrganizationalChartController extends Controller
{
    public function beforeAction($action)
    {
        switch ($action->id) {
            case 'export':
                $this->enableCsrfValidation = false;
                Yii::$app->request->parsers = [
                    'application/json' => 'yii\web\JsonParser'
                ];
                break;
            
            default:
                // code...
                break;
        }

        return parent::beforeAction($action);
    }

    public function actionUpload()
    {
        $model = new DocumentSettingForm();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Upload Success');

            return $this->redirect(['upload']);
        }

        return $this->render('upload', [
            'model' => $model
        ]);
    }

    public function actionIndex()
    {
        $model = new SystemSettingForm();

        return $this->render('index', [
            'model' => $model
        ]);
    }
    
    public function actionExport($version='')
    {
        $post = App::post();

        switch ($post['options']['ext']) {
            case 'pdf':
                $pdf = App::component('pdf');
                // $pdf->format = \kartik\mpdf\Pdf::FORMAT_FOLIO;
                // $pdf->orientation = $this->orientation;
                $pdf->filename = $post['options']['filename'];
                $pdf->content = $this->renderPartial('export-pdf', ['post' => $post]);
                $pdf->cssInline = str_replace(['<style data-boc-styles="">', '</style>'], '', $post['styles']);

                return $pdf->render();
                break;
            
            default:
 
                // $svg = $post['content'];
 

                // header('Content-Type: image/png');

                // $im = new \Imagick();
                // $im->readImageBlob($svg);
                // $im->transparentPaintImage("white", 0, 0, false);

                // $im->setImageFormat("png64");

                // return $im;
                // $im->writeImage("image.png");
                // $im->clear();
                // $im->destroy();


                break;
        }
    }

    public function actionSave()
    {
        $model = new SystemSettingForm();

        if ($model->load(['SystemSettingForm' => App::post()]) && $model->save()) {

            return $this->asJson([
                'status' => 'success',
                'message' => 'Organizational Chart saved.'
            ]);
        }

        return $this->asJson([
            'status' => 'failed',
            'message' => $model->errors
        ]);
    }
}