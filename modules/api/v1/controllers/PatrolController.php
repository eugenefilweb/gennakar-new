<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\form\SyncPatrol;

class PatrolController extends ActiveController
{
    public $modelClass = 'app\modules\api\v1\models\Patrol';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'patrol',
    ];

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareSearchQuery'] = function($query, $requestParams) {
            $query->andFilterWhere(['or', 
            //     ['like', 'notes', $requestParams['keywords'] ?? ''],  
                // ['like', 'watershed', $requestParams['keywords'] ?? ''],  
                ['like', 'status', $requestParams['status'] ?? ''],  
            ]);

           // $query->andWhere(['user_id' => $requestParams['user_id']]);
            $query->andWhere(['created_by' => App::identity('id')]);
            // $query->andWhere(['status' => $requestParams['status']]);

            return $query;
        };

        return $actions;
    }

    public function actionSync()
    {
        try {
            $model = new SyncPatrol(App::post());

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