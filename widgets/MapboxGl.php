<?php

namespace app\widgets;

use app\helpers\Url;

class MapboxGl extends BaseWidget
{
    public $access_token = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
    public $height = '100%';


    public function init() 
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('mapbox-gl/index', [
            'height' => $this->height,
            'access_token' => $this->access_token
        ]);    
    }
}