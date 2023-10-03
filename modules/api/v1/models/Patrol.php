<?php

namespace app\modules\api\v1\models;

use app\modules\api\v1\helpers\App;
use app\modules\api\v1\helpers\Url;
use app\modules\api\v1\models\Tree;
use app\modules\api\v1\models\Fauna;

class Patrol extends \app\models\Patrol
{
    public function fields()
    {
        $fields = parent::fields();

        $fields['totalFauna'] = fn ($model) => 0;
        $fields['totalTrees'] = 'totalTrees';
        $fields['createdAt'] = 'createdAt';
        $fields['statusLabel'] = 'statusLabel';
        $fields['travelHours'] = 'travelHours';
        $fields['tripId'] =  fn ($model) => "{$model->tripId} ";
        $fields['totalDistance'] =  fn ($model) => App::formatter()->asDistance($model->distance);
        $fields['totalCoordinates'] = fn ($model) => number_format(count($model->coordinates));
        $fields['floras'] = 'floras';
        $fields['faunas'] = 'faunas' /* fn ($model) => [] */;
        $fields['statusClass'] = fn ($model) => $model->status == 1 ? 'success': 'primary';
       
        return $fields;
    }

    public function getFloras()
    {
        return $this->hasMany(Tree::class, ['patrol_id' => 'id']);
    }

    public function getFaunas()
    {
        return $this->hasMany(Fauna::class, ['patrol_id' => 'id']);
    }

    public function getCanActivate()
    {
        return true;
    }
}