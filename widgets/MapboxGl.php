<?php

namespace app\widgets;

class Mapboxgl extends BaseWidget
{
    public $access_token = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
    public $height = '100%';
    public $center;
    public $zoom;

    public function init() 
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('mapboxgl/index', [
            'height' => $this->height,
            'accessToken' => $this->access_token,
            'zoom' => $this->zoom,
            'center' => $this->center
        ]);    
    }
}