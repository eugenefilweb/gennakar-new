<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\Url;
use app\models\form\OpenWeatherApiForm;

class OpenWeatherApi extends BaseWidget
{
    public $data;
    public $template = 'current-weather';
    public $currentForecast;
    public $withPrint = false;
    public $sypnosisData;
    public $refreshUrl = ['dashboard/index', 'type' => 'weather-refresh'];
    public $autoRefresh = false;
    public $autoRefreshInterval = 60 * 1000;
    public $autoRefreshCallback;

    public function setCurrentForecast()
    {
        $currentForecast = [];

        $MAX_TEMP_C = null;
        $MAX_TEMP_DATE = null;

        $MIN_TEMP_C = null;
        $MIN_TEMP_DATE = null;

        $MAX_1H_RAIN = null;
        $MAX_1H_RAIN_DATE = null;

        $MAX_3H_RAIN = null;
        $MAX_3H_RAIN_DATE = null;

        $MAX_WIND = null;
        $MAX_WIND_DATE = null;

        foreach ($this->data['forecast']['list'] as $list) {
            list($date, $time) = explode(' ', $list['dt_txt']);

            $currentForecast[$date][$time] = [
                'icon' => $list['weather'][0]['icon'],
                'main' => $list['weather'][0]['main'],
                'temp' => $list['main']['temp'] - 273.15,
                'dt_txt' => $list['dt_txt'],
            ];

            $MAX_TEMP_C = ($MAX_TEMP_C === null)? $list['main']['temp']: $MAX_TEMP_C;
            $MAX_TEMP_DATE = ($MAX_TEMP_DATE === null)? $list['dt_txt']: $MAX_TEMP_DATE;

            $MIN_TEMP_C = ($MIN_TEMP_C === null)? $list['main']['temp']: $MIN_TEMP_C;
            $MIN_TEMP_DATE = ($MIN_TEMP_DATE === null)? $list['dt_txt']: $MIN_TEMP_DATE;

            $MAX_1H_RAIN = ($MAX_1H_RAIN === null)? ($list['rain']['1h'] ?? 0): $MAX_1H_RAIN;
            $MAX_1H_RAIN_DATE = ($MAX_1H_RAIN_DATE === null)? $list['dt_txt']: $MAX_1H_RAIN_DATE;

            $MAX_3H_RAIN = ($MAX_3H_RAIN === null)? ($list['rain']['3h'] ?? 0): $MAX_3H_RAIN;
            $MAX_3H_RAIN_DATE = ($MAX_3H_RAIN_DATE === null)? $list['dt_txt']: $MAX_3H_RAIN_DATE;

            $MAX_WIND = ($MAX_WIND === null)? ($list['wind']['speed'] ?? 0): $MAX_WIND;
            $MAX_WIND_DATE = ($MAX_WIND_DATE === null)? $list['dt_txt']: $MAX_WIND_DATE;

            if ($list['main']['temp'] > $MAX_TEMP_C) {
                $MAX_TEMP_C = $list['main']['temp'];
                $MAX_TEMP_DATE = $list['dt_txt'];
            }

            if ($list['main']['temp'] < $MIN_TEMP_C) {
                $MIN_TEMP_C = $list['main']['temp'];
                $MIN_TEMP_DATE = $list['dt_txt'];
            }

            if (($list['rain']['1h'] ?? 0) > $MAX_1H_RAIN) {
                $MAX_1H_RAIN = ($list['rain']['1h'] ?? 0);
                $MAX_1H_RAIN_DATE = $list['dt_txt'];
            }

            if (($list['rain']['3h'] ?? 0) > $MAX_3H_RAIN) {
                $MAX_3H_RAIN = ($list['rain']['3h'] ?? 0);
                $MAX_3H_RAIN_DATE = $list['dt_txt'];
            }

            if (($list['wind']['speed'] ?? 0) > $MAX_WIND) {
                $MAX_WIND = ($list['rain']['3h'] ?? 0);
                $MAX_WIND_DATE = $list['dt_txt'];
            }
        }

        $formatter = App::formatter();

        $this->sypnosisData = [
            'MAX_TEMP_C' => $formatter->asKelvinToCelcius($MAX_TEMP_C),
            'MAX_TEMP_F' => $formatter->asKelvinToFahrenheit($MAX_TEMP_C),
            'MAX_TEMP_DATE' => $formatter->asDateFormat($MAX_TEMP_DATE, 'D d'),
            'MIN_TEMP_C' => $formatter->asKelvinToCelcius($MIN_TEMP_C),
            'MIN_TEMP_F' => $formatter->asKelvinToFahrenheit($MIN_TEMP_C),
            'MIN_TEMP_DATE' => $formatter->asDateFormat($MIN_TEMP_DATE, 'D d'),
            'MAX_1H_RAIN' => $MAX_1H_RAIN,
            'MAX_1H_RAIN_DATE' => $formatter->asDateFormat($MAX_1H_RAIN_DATE, 'D d'),
            'MAX_3H_RAIN' => $MAX_3H_RAIN,
            'MAX_3H_RAIN_DATE' => $formatter->asDateFormat($MAX_3H_RAIN_DATE, 'D d'),
            'MAX_WIND' => $MAX_WIND,
            'MAX_WIND_DATE' => $formatter->asDateFormat($MAX_WIND_DATE, 'D d'),
        ];

        $this->currentForecast = reset($currentForecast);
    }

    public function init() 
    {
        parent::init(); 

        $this->refreshUrl = is_array($this->refreshUrl)? Url::toRoute($this->refreshUrl): $this->refreshUrl;

        $model = new OpenWeatherApiForm();

        $this->data['currentWeather'] = ArrayHelper::objectToArray($model->currentWeather());
        $this->data['forecast'] = ArrayHelper::objectToArray($model->forecast());
        $this->setCurrentForecast();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render("open-weather-api/{$this->template}", [
            'data' => $this->data,
            'currentWeather' => $this->data['currentWeather'],
            'forecast' => $this->data['forecast'],
            // 'days' => $this->days,
            // 'weather' => $this->weather,
            // 'maxTempArr' => $this->maxTempArr,
            // 'minTempArr' => $this->minTempArr,
            // 'maxPrecipMM' => $this->maxPrecipMM,
            // 'maxWind' => $this->maxWind,
            // 'withNextDays' => $this->withNextDays,
            'withPrint' => $this->withPrint,
            'currentForecast' => $this->currentForecast,
            'sypnosisData' => $this->sypnosisData,
            'refreshUrl' => $this->refreshUrl,
            'autoRefresh' => $this->autoRefresh,
            'autoRefreshInterval' => $this->autoRefreshInterval,
            'autoRefreshCallback' => $this->autoRefreshCallback,
        ]);
    }
}
