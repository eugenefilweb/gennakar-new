<?php

namespace app\models\form;

class OpenWeatherApiForm extends \yii\base\Model
{
    public $appid = '5aa4da851b3c5bd5dc8b945666c3f2e7';
    public $lat = '14.75738071184537';
    public $lon = '121.62029385566711';

    public $baseApiUrl = 'https://api.openweathermap.org/data/2.5/';
    public $currentWeatherApi = 'weather';
    public $forecastApi = 'forecast';
   
    public function rules()
    {
        return [
            [['appid', 'lat', 'lon', 'baseApiUrl', 'currentWeatherApi', 'forecastApi'], 'required'],
            [['appid', 'lat', 'lon', 'baseApiUrl', 'currentWeatherApi', 'forecastApi'], 'string'],
        ];
    }

    // REQUEST AI CALL
    public function request($link,$data) 
    { 
        $post = array_merge(array('appid' => $this->appid), $data);

        return json_decode($this->connect($post,$link));
    }

    private function connect($post,$link) 
    {
        $_post = array();
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name.'='.urlencode($value);
            }
        }

        if (is_array($post)) {
            $url_complete = join('&', $_post);
        }

        $url = implode('?', [$link, $url_complete]);

        //Initialize cURL.
        $ch = curl_init();
        //Set the URL that you want to GET by using the CURLOPT_URL option.
        curl_setopt($ch, CURLOPT_URL, $url);
        //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //Execute the request.
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function fetch($link)
    {
        $link = $this->baseApiUrl . $link;


        $data = $this->request($link, [
            'lat' => $this->lat,
            'lon' => $this->lon,
        ]);

        return $data;
    }

    public function currentWeather()
    {
        $data = $this->fetch($this->currentWeatherApi);
        return $data;
    }

    public function forecast()
    {
        $data = $this->fetch($this->forecastApi);
        return $data;
    }
}