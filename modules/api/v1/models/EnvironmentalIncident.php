<?php

namespace app\modules\api\v1\models;
use app\modules\api\v1\helpers\App;
use app\modules\api\v1\helpers\Url;

class EnvironmentalIncident extends \app\models\EnvironmentalIncident
{
    
    public function getCanActivate()
    {
        return true;
    }
	
}