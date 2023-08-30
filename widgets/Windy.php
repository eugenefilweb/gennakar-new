<?php

namespace app\widgets;

use app\helpers\Html;

class Windy extends BaseWidget
{
    public $url = 'https://embed.windy.com/embed2.html';
    public $options = [
        'style' => 'width: 100%',
        'frameborder' => 0
    ];

    public $lat = 13.678;
    public $lon = 121.635;
    public $detailLat = 14.75689358;
    public $detailLon = 121.6190742;
    public $width = 700;
    public $height = 500;
    public $zoom = 5;
    public $level = 'surface';
    public $overlay = 'wind';
    public $product = 'ecmwf';
    public $menu =  '';
    public $message = true;
    public $marker = true;
    public $calendar = 'now';
    public $pressure = true;
    public $type = 'map';
    public $location = 'coordinates';
    public $detail = true;
    public $metricWind = 'default';
    public $metricTemp = 'default';
    public $radarRange = -1;

    public function init()
    {
        parent::init();

        $this->options['width'] = $this->width;
        $this->options['height'] = $this->height;
        $this->options['src'] = $this->createSource();
    }

    public function createSource()
    {
        return implode('?', [
            $this->url,
            http_build_query([
                'lat' => $this->lat,
                'lon' => $this->lon,
                'detailLat' => $this->detailLat,
                'detailLon' => $this->detailLon,
                'width' => $this->width,
                'height' => $this->height,
                'zoom' => $this->zoom,
                'level' => $this->level,
                'overlay' => $this->overlay,
                'product' => $this->product,
                'menu' => $this->menu,
                'message' => $this->message,
                'marker' => $this->marker,
                'calendar' => $this->calendar,
                'pressure' => $this->pressure,
                'type' => $this->type,
                'location' => $this->location,
                'detail' => $this->detail,
                'metricWind' => $this->metricWind,
                'metricTemp' => $this->metricTemp,
                'radarRange' => $this->radarRange,
            ])
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return Html::tag('iframe', '', $this->options);
    }
}
