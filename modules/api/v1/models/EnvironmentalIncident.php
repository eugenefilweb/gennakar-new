<?php

namespace app\modules\api\v1\models;

class EnvironmentalIncident extends \app\models\EnvironmentalIncident
{
    
    
    
    public function getCanActivate()
    {
        return true;
    }
	
}