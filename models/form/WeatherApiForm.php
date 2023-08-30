<?php

namespace app\models\form;

class WeatherApiForm extends \yii\base\Model
{
    public $api_key = 'f11c8fd9828f444f83620217221209';
    public $q = 'General Nakar, Philippines';
    public $format = 'json';
    public $includelocation = 'yes';
   
    public function rules()
    {
        return [
            [['api_key', 'q', 'format', 'includelocation'], 'required'],
            [['api_key', 'q', 'format', 'includelocation'], 'string'],
        ];
    }

    // REQUEST AI CALL
    public function request($link,$data) 
    { 
        $post = array_merge(array('key' => $this->api_key), $data);
        return json_decode($this->connect($post,$link));
    }

    private function connect($post,$link) 
    {
        $_post = Array();
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name.'='.urlencode($value);
            }
        }

        if (is_array($post)) {
            $url_complete = join('&', $_post);
        }

        $url = $link.$url_complete;
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
         $data = $this->request($link, [
            'q' => $this->q,
            'format' => $this->format,
            'includelocation' => $this->includelocation,
        ]);

        return (array) $data;
    }

    public function localWeather()
    {
        $data = $this->fetch('http://api.worldweatheronline.com/premium/v1/weather.ashx?');
        return (array) $data;
    }


    /*//=========================================//

    //Time Zone  api call Request   

    //=========================================// 
    $TimeZone = $api->request('http://api.worldweatheronline.com/premium/v1/tz.ashx?',
    array(
    'q' => 'Paris',
    'format' => 'json',
    'includelocation' => 'yes'
    ));
    //=========================================//


    //Search  api call Request   

    //=========================================// 
    $Search = $api->request('http://api.worldweatheronline.com/premium/v1/search.ashx?',
    array(
    'q' => 'London',
    'format' => 'json'
    ));
    //=========================================//

    //Historical Local  api call Request   

    //=========================================// 
    $HistoricalLocal = $api->request('http://api.worldweatheronline.com/premium/v1/past-weather.ashx?',
    array(
    'q' => 'Paris',
    'format' => 'json',
    'includelocation' => 'yes',
    'date' => '2017-08-15',
    'enddate' => '2017-09-10'
    ));
    //=========================================//


    //Historical  Marine api call Request   

    //=========================================// 
    $HistoricalMarine = $api->request('http://api.worldweatheronline.com/premium/v1/past-marine.ashx?',
    array(
    'q' => '31.50,-12.50',
    'format' => 'json',
    'includelocation' => 'yes',
    'date' => '2017-08-15',
    'enddate' => '2017-09-10'
    ));
    //=========================================//



    //Ski Weather   api call Request   

    //=========================================// 
    $SkiWeather = $api->request('http://api.worldweatheronline.com/premium/v1/ski.ashx?',
    array(
    'q' => '52.233,-90.75',
    'format' => 'json',
    'includelocation' => 'yes'

    ));

    //=========================================//*/

}