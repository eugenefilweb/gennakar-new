<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\Library;
use app\models\search\LibrarySearch;


class PatrolHistoryController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Library::findByKeywords($keywords, ['id'])
        );
    }

    public function actionIndex()
    {
        $searchModel = new LibrarySearch(['searchLabel' => 'Patrol History']);
        $dataProvider = $searchModel->search(['LibrarySearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view');
    }
}