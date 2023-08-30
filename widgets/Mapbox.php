<?php

namespace app\widgets;

use app\helpers\Url;

class Mapbox extends BaseWidget
{
    public $access_token = 'pk.eyJ1Ijoicm9lbGZpbHdlYiIsImEiOiJjbGh6am1tankwZzZzM25yczRhMWhhdXRmIn0.aLWnLb36hKDFVFmKsClJkg';
    public $height = '70vh';
    public $lnglat = [121.6203181, 14.7571113];
    public $enableDrawing = true;
    public $enableGeocoder = true;
    public $enableNavigationController = false;
    public $mapLoadScript;
    public $initLoadScript;
    public $dataloadingScript;
    public $sourcedataScript;
    public $styleUrl;
    public $zoom = 10;

    public function init() 
    {
        parent::init();

        $this->styleUrl = $this->styleUrl ?: Url::to('default/geojson/style/style.json', true);
    }

    public function run()
    {
        return $this->render('mapbox/index', [
            'access_token' => $this->access_token,
            'lnglat' => json_encode($this->lnglat),
            'height' => $this->height,
            'enableGeocoder' => $this->enableGeocoder ? 'true': 'false',
            'enableNavigationController' => $this->enableNavigationController ? 'true': 'false',
            'enableDrawing' => $this->enableDrawing ? 'true': 'false',
            'mapLoadScript' => $this->mapLoadScript,
            'initLoadScript' => $this->initLoadScript,
            'dataloadingScript' => $this->dataloadingScript,
            'sourcedataScript' => $this->sourcedataScript,
            'styleUrl' => $this->styleUrl,
            'zoom' => $this->zoom,
        ]);    
    }
}