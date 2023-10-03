<?php

namespace app\modules\api\v1\controllers;

use yii\data\ActiveDataProvider;
use app\modules\api\v1\models\Library;
use app\modules\api\v1\helpers\App;

class LibraryController extends ActiveController
{
    public $modelClass = 'app\modules\api\v1\models\Library';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'library',
    ];

    public function actions()
    {
        $actions = parent::actions();

        // $actions['index']['prepareSearchQuery'] = function($query, $requestParams) {
        //     $query->andFilterWhere(['or', 
        //         ['like', 'family', $requestParams['keywords'] ?? ''],  
        //         ['like', 'genus', $requestParams['keywords'] ?? ''],  
        //         ['like', 'species', $requestParams['keywords'] ?? ''],  
        //         ['like', 'common_name', $requestParams['keywords'] ?? ''],  
        //         ['like', 'taxonomic_group', $requestParams['keywords'] ?? ''],  
        //         ['like', 'growth_habit', $requestParams['keywords'] ?? ''],  
        //         ['like', 'conservation_status', $requestParams['keywords'] ?? ''],  
        //         ['like', 'distribution_status', $requestParams['keywords'] ?? ''],  
        //     ]);

        //     return $query;
        // };


        unset($actions['index']);
        return $actions;

        return $actions;
    }

    public function actionIndex()
    {
        $requestParams = App::queryParams();
        return new ActiveDataProvider([
            'query' => library::find()
                ->andFilterWhere([
                    'or',
                    ['like', 'family', $requestParams['keywords'] ?? ''],
                    ['like', 'genus', $requestParams['keywords'] ?? ''],
                    ['like', 'species', $requestParams['keywords'] ?? ''],
                    ['like', 'common_name', $requestParams['keywords'] ?? ''],
                    // ['like', 'taxonomic_group', $requestParams['keywords'] ?? ''],
                    ['like', 'growth_habit', $requestParams['keywords'] ?? ''],
                    ['like', 'conservation_status', $requestParams['keywords'] ?? ''],
                    ['like', 'distribution_status', $requestParams['keywords'] ?? ''],
                ]),
            'pagination' => [
                'pageSizeLimit' => [0, 1000]
            ],
        ]);
    }
}
