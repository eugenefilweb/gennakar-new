<?php

namespace app\modules\api\v1\controllers;
use Yii;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\models\HazardMap;
use app\modules\api\v1\models\Barangay;

class SettingController extends ActiveController
{
    public $modelClass = 'app\modules\api\v1\models\Setting';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'setting',
    ];

    public function beforeAction($action)
    {
        switch ($action->id) {
            case 'general':
                $this->detachBehavior('authenticator');
                break;
            
            case 'test':
                $this->detachBehavior('authenticator');
                break;
            
            default:
                // code...
                break;
        }

        return parent::beforeAction($action);
    }


    public function actionGeneral()
    {
        return [
            'general' => App::setting('mobileApp'),
            'watersheds' => HazardMap::watersheds(),
            'incidents' =>App::params('incidents'),
            'floras' =>App::params('floras'),
            'faunas' =>App::params('faunas'),
            'barangays' => Barangay::barangays(),
        ];
    }
    
    
    
     public function actionIncidents()
    {
        return [
            'incidents' =>App::params('incidents'),
            
        ];
    }
    
    
}