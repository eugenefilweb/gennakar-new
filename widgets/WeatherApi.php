<?php

namespace app\widgets;

use app\helpers\ArrayHelper;
use app\models\form\WeatherApiForm;

class WeatherApi extends BaseWidget
{
    public $data;
    public $template = 'local-weather';
    public $days = 0;
    public $weather = [];
    public $maxTempArr = [];
    public $minTempArr = [];

    public $withPrint = false;

    public $maxPrecipMM = [];
    public $maxWind = [];

    public $withNextDays = false;

    public function init() 
    {
        parent::init(); 

        $this->data = $this->data ?: (new WeatherApiForm())->localWeather();

        if ($this->data) {
            if (isset($this->data['data'])) {

                if (($this->weather = $this->data['data']->weather) != null) {
                    $this->days = count($this->weather);

                    $arr = ArrayHelper::index($this->weather, 'maxtempF');

                    $this->maxTempArr = $arr[max(array_keys($arr))];
                    $this->minTempArr = $arr[min(array_keys($arr))];

                    $_precipMM = [];
                    $_wind = [];

                    foreach ($this->weather as $weather) {
                        $precipMM = ArrayHelper::index($weather->hourly, 'precipMM');
                        $_precipMM[$weather->date] = $precipMM[max(array_keys($precipMM))];
                        $_precipMM[$weather->date]->date = $weather->date; 


                        $windspeedKmph = ArrayHelper::index($weather->hourly, 'windspeedKmph');
                        $_wind[$weather->date] = $windspeedKmph[max(array_keys($windspeedKmph))];
                        $_wind[$weather->date]->date = $weather->date; 
                    }

                    $arr1 = ArrayHelper::index($precipMM, 'precipMM');
                    $this->maxPrecipMM = $arr1[max(array_keys($arr1))];

                    $arr2 = ArrayHelper::index($precipMM, 'windspeedKmph');
                    $this->maxWind = $arr2[max(array_keys($arr2))];
                }
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render("weather-api/{$this->template}", [
            'data' => $this->data,
            'days' => $this->days,
            'weather' => $this->weather,
            'maxTempArr' => $this->maxTempArr,
            'minTempArr' => $this->minTempArr,
            'maxPrecipMM' => $this->maxPrecipMM,
            'maxWind' => $this->maxWind,
            'withNextDays' => $this->withNextDays,
            'withPrint' => $this->withPrint,
        ]);
    }
}
