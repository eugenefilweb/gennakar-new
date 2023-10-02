<?php

namespace app\widgets;
use Yii;

class Mapboxgl extends BaseWidget
{
    public $accessToken;
    public $height = '100%';
    public $center = [121.048442,14.361508];
    public $zoom = 10;
    public $patrolCoordinates;
    public $floraCoordinates;
    public $faunaCoordinates;
    public $enableDrawing = true;
    public $multipleDirections = true;

    public function init() 
    {
        parent::init();
        
        $this->accessToken = Yii::$app->params['mapbox']['accessToken'];
    }

    public function run()
    {
        return $this->render('mapboxgl/index', [
            'accessToken' => $this->accessToken,
            'height' => $this->height,
            'center' => json_encode($this->center),
            'zoom' => $this->zoom,
            'floraCoordinates' =>  json_encode($this->floraCoordinates),
            'patrolCoordinates' => json_encode($this->patrolCoordinates),
            'faunaCoordinates' => json_encode($this->faunaCoordinates),
            'enableDrawing' => json_encode($this->enableDrawing),
            'multipleDirections' => json_encode($this->multipleDirections),
        ]);    
    }
}