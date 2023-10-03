<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\helpers\Url;
use app\modules\api\v1\models\Patrol;
use app\modules\api\v1\models\Fauna;
use app\modules\api\v1\models\form\SyncPatrolForm;
use app\modules\api\v1\models\form\UploadForm;
use yii\db\Expression;
use yii\web\UploadedFile;

class FaunaController extends ActiveController
{
    public $modelClass = 'app\modules\api\v1\models\Fauna';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'fauna',
    ];

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareSearchQuery'] = function($query, $requestParams) {
            $query->andFilterWhere(['or', 
                ['like', 'kingdom', $requestParams['keywords'] ?? ''],  
                ['like', 'family', $requestParams['keywords'] ?? ''],  
                ['like', 'genus', $requestParams['keywords'] ?? ''],  
                ['like', 'species', $requestParams['keywords'] ?? ''],  
                ['like', 'common_name', $requestParams['keywords'] ?? ''],  
                // ['like', 'taxonomic_group', $requestParams['keywords'] ?? ''],  
                ['like', 'growth_habit', $requestParams['keywords'] ?? ''],  
                ['like', 'category_id', $requestParams['keywords'] ?? ''],  
                ['like', 'conservation_status', $requestParams['keywords'] ?? ''],  
                ['like', 'diameter', $requestParams['keywords'] ?? ''],  
            ]);
            $query->andWhere(['status' => $requestParams['status'] ?? Fauna::VALIDATED]);
            $query->andWhere(['created_by' => App::identity('id')]);
            $query->orderBy(['id' => SORT_DESC]);
            return $query;
        };

        return $actions;
    }

    public function actionSyncFaunaPatrol()
    {
        // return App::post();
        try {
            $model = new SyncPatrolForm(App::post());

            return $model->sync();
        } catch (\yii\base\ErrorException $e) {

            return [
                'status' => false,
                'message' => $e->getMessage(),
                'error' => $e,
            ];
        }
    }
}