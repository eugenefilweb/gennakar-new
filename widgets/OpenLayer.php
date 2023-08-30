<?php

namespace app\widgets;

use app\helpers\App;
 
class OpenLayer extends BaseWidget
{
    // const LATITUDE = 13538765.158516249;
    // const LONGITUDE = 1661223.2792549322;
    const LATITUDE = 14.7570732;
    const LONGITUDE = 121.6187192;

    public $height = '600px';
    public $zoom;
    public $latitude;
    public $longitude;
    public $clickCallback;
    public $withLine = false;
    public $coordinates = [];
    public $multipleCoordinates = [];

    public $withSearch = true;
    public $clearMarkersOnClick = true;
    public $addMarkers = true;
    public $addStartMarker = false;
    public $addEndMarker = false;
    public $showCurrentLocation = false;
    public $asEPSG3857 = false;
    
    public function init() 
    {
        // your logic here
        parent::init();


        $this->latitude = $this->latitude ?: self::LATITUDE;
        $this->longitude = $this->longitude ?: self::LONGITUDE;

        if ($this->asEPSG3857) {
            if($this->latitude != self::LATITUDE && $this->longitude != self::LONGITUDE) {
                $data = App::formatter()->asEPSG3857([
                    'lat' => $this->latitude,
                    'lon' => $this->longitude
                ]);

                $this->latitude = $data['lon'];
                $this->longitude = $data['lat'];
            }
        }

        $this->zoom = $this->zoom ?: 12;

        if ($this->coordinates) {
            $this->coordinates = array_values($this->coordinates);
            $center = App::formatter()->asCenterCoordinate($this->coordinates);
            $this->latitude = $center['lat'];
            $this->longitude = $center['lon'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('open-layer/index', [
            'height' => $this->height,
            'zoom' => (int)$this->zoom,
            'latitude' => (float)$this->latitude,
            'longitude' => (float)$this->longitude,
            'clickCallback' => $this->clickCallback,
            'clickable' => $this->clickCallback ? 'true': 'false',
            'withLine' => $this->withLine ? 'true': 'false',
            'withSearch' => $this->withSearch ? 'true': 'false',
            'clearMarkersOnClick' => $this->clearMarkersOnClick ? 'true': 'false',
            'addMarkers' => $this->addMarkers ? 'true': 'false',
            'addStartMarker' => $this->addStartMarker ? 'true': 'false',
            'addEndMarker' => $this->addEndMarker ? 'true': 'false',
            'showCurrentLocation' => $this->showCurrentLocation ? 'true': 'false',
            'coordinates' => json_encode($this->coordinates),
            'multipleCoordinates' => json_encode($this->multipleCoordinates),
        ]);
    }
}
