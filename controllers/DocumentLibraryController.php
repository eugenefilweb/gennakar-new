<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\FileHelper;
use app\models\File;
use app\models\form\FileForm;
use app\models\search\FileSearch;

class DocumentLibraryController extends Controller
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            File::findByKeywords($keywords, ['name', 'tag', 'extension', 'token'])
        );
    }
    
    public function actionIndex()
    {
        if (App::isAjax()) {
            return $this->asJson([
                'html' => $this->renderAjax('_document', [
                    'path' => App::post('path'),
                ])
            ]);
        }
        $searchModel = new FileSearch([
            'searchAction' => ['document-library/index']
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

    public function actionAddFolder()
    {
        $folderPath = App::post('folderPath');
        $folderName = App::post('folderName');

        $path = Yii::getAlias('@webroot/protected/uploads');
        $path = implode(DIRECTORY_SEPARATOR, [$path, $folderPath, $folderName]);
        $path = FileHelper::normalizePath($path);

        FileHelper::createDirectory($path);

        return $this->asJson([
            'path' => $path
        ]);
    }
}