<?php

namespace app\controllers;

use app\helpers\App;
use app\models\form\FileForm;
use app\models\search\FileSearch;


class ToolkitGuideController extends Controller
{
    public function actionIndex($path='')
    {
        if (App::isAjax()) {
            return $this->asJson([
                'html' => $this->renderAjax('_document', [
                    'path' => App::post('path'),
                ])
            ]);
        }

        if (! $path) {
            return $this->redirect(['index', 'path' => 'Toolkit Guide']);
        }
        $searchModel = new FileSearch([
            'searchAction' => ['toolkit-guide/index', 'path' => 'Toolkit Guide'],
            'tag' => 'Toolkit Guide'
        ]);

        $searchModel->pagination = 12;
        $dataProvider = $searchModel->search(['FileSearch' => App::queryParams()]);

        $data = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => new FileForm()
        ];

        if (App::isAjax()) {
            return $this->renderPartial('/files/my-files-ajax', $data);
        }

        return $this->render('index', $data);
    }
}