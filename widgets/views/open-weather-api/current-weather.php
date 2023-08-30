<?php

use app\helpers\Html;
use app\helpers\App;

$this->registerCss(<<< CSS
    #{$widgetId} .weather-now-city {
        padding: 20px 22px 16px;
    }
    #{$widgetId} .box {
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0%,0%,5%);
        border-radius: 5px;
        padding: 25px 21px;
        margin-bottom: 15px;
        position: relative;
    }
    #{$widgetId} .head-alert {
        display: flex;
        align-items: baseline;
    }
    #{$widgetId} .head2 {
        font-weight: 600;
        font-size: 24px;
        line-height: 33px;
        color: #353a3e;
        margin-right: 20px;
        white-space: nowrap;
    }
    #{$widgetId} .weather-summary-hr {
        margin-right: -21px;
        margin-top: 5px;
        margin-bottom: 11px;
        border: 0;
        border-top: 1px solid rgba(34,34,34,.1);
    }
    #{$widgetId} .weather-summary {
        display: flex;
        margin-top: 20px;
    }
    #{$widgetId} .weather-widget {
        display: flex;
        position: relative;
        padding-top: 5px;
        width: 25%;
    }
    
    #{$widgetId} .weather-widget-temperature {
        font-size: 80px;
        line-height: 69px;
        letter-spacing: -.065em;
        color: #222;
        text-align: center;
        margin: auto;
    }
    #{$widgetId} .weather-summary-details {
        flex-grow: 1;
        flex-wrap: wrap;
        width: 75%;
    }
    #{$widgetId} .ws-details {
        display: flex;
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
        padding-right: 7px;
        font-size: 14px;
        line-height: 19px;
        color: #222;
        padding-top: 3px;
    }
    #{$widgetId} .ws-details {
        font-size: 14px;
        line-height: 19px;
        color: #222;
    }

    #{$widgetId} .wind-direction span.wind {
        font-weight: 400;
        font-size: 14px;
        line-height: 19px;
        color: #343434;
        padding-left: 6px;
    }

    #{$widgetId} .wind-direction img {
        padding-left: 5px;
        padding-right: 8px;
        padding-bottom: 1px;
    }

    #{$widgetId} .ws-details-item span {
        font-weight: 700;
    }

    #{$widgetId} .wind-speed {
        background-color: #f19100;
        border-radius: 2px;
        color: #fff;
        padding: 1px 3px;
        margin-left: 2px;
        margin-right: 4px;
    }

    #{$widgetId} .wind-direction {
        display: inline;
        width: 42px;
        height: 23px;
        border: 1px solid #222;
        box-sizing: border-box;
        border-radius: 50px;
        padding-top: 1px;
        padding-bottom: 1px;
    }
    #{$widgetId} .days-details {
        display: flex;
        position: relative;
        overflow-x: auto;
        flex-direction: row;
        margin-right: -10px;
        margin-left: -10px;
    }
    #{$widgetId} .days-details-table {
        width: 100%;
        margin-top: 7px;
    }
    #{$widgetId} .days-details-row {
        height: 77px;
        align-items: center;
        background-color: initial;
    }
    #{$widgetId} .days-details-row-item:first-child {
        text-align: left;
        padding-left: 10px;
        width: 165px;
    }
    #{$widgetId} .weather-hour-item {
        font-size: 14px;
        line-height: 19px;
        text-align: center;
        color: #343434;
    }
    #{$widgetId} .weather-hour-item p {
        margin-bottom: 0;
    }
    #{$widgetId} .weather-hour-item img {
        margin-bottom: 5px;
        margin: 0 auto;
    }
    #{$widgetId} .weather-hour-item p:last-child {
        font-size: 16px;
        line-height: 22px;
        color: #222;
    }
    #{$widgetId} .report-text:last-child {
        margin-bottom: 0;
    }

    #{$widgetId} .weather-text {
        font-size: 16px;
        line-height: 24px;
        color: #7a7a7a;
        margin-top: 17px;
        margin-bottom: 5px;
    }
    #{$widgetId} .feels {
        font-size: 14px;
        line-height: 19px;
        color: #222;
        opacity: .5;
        letter-spacing: .3px;
        padding-top: 8px;
        margin-bottom: 0;
    }

    #{$widgetId} .rise-set {
        font-size: 12px;
        line-height: 16px;
        color: #222;
        display: flex;
    }
    #{$widgetId} .ws-details-hr {
        margin-top: 11px;
        margin-bottom: 16px;
        border: 0;
        border-top: 1px solid rgba(34,34,34,.1);
    }
    #{$widgetId} .rise {
        margin-right: 49px;
    }
    #{$widgetId} .rise-set p {
        margin-bottom: 10px;
    }
    #{$widgetId} .weather-widget-icon p {
        font-size: 24px;
        line-height: 33px;
        color: #222;
    }
    #{$widgetId} .rise-set span {
        font-weight: 700;
        padding-left: 3px;
    }
    #{$widgetId} .report-text {
        font-size: 16px;
        line-height: 26px;
        color: #7a7a7a;
        margin-bottom: 27px;
    }

    #{$widgetId} .br-10 {
        border-radius: 10px;
    }

    #{$widgetId} .br-5 {
        border-radius: 5px;
    }
CSS);
if ($autoRefresh) {
}

App::if($autoRefresh, fn () => $this->registerJs(<<< JS
    setInterval(function () {
        $.ajax({
            url: '{$refreshUrl}',
            dataType: 'json',
            method: 'get',
            success: (s) => {
                {$autoRefreshCallback}
            },
            error: (e) => {
                console.log(e)
                // alert(e.responseText);
            }
        })
    }, {$autoRefreshInterval});
JS));
?>

<div id="<?= $widgetId ?>">
    <div class="box weather-now-city">
        <div class="head-alert">
            <h2 class="head2"> Current Weather (General Nakar, Quezon) </h2>

            <?= Html::if($withPrint, Html::tag('span', Html::a('Print', ['dashboard/print-weather'], [
                'class' => 'btn btn-secondary font-weight-bold',
                'target' => '_blank'
            ]), [
                'class' => 'text-right',
                'style' => 'width: -webkit-fill-available;',
            ])) ?>

        </div>
        <hr class="weather-summary-hr">
        <div class="weather-summary">
            <div class="weather-widget">
                <div class="weather-widget-icon">
                    <img class="br-10 img-fluid" src="http://openweathermap.org/img/wn/<?= $currentWeather['weather'][0]['icon'] ?>@2x.png" alt="<?= $currentWeather['weather'][0]['description'] ?>" title="<?= $currentWeather['weather'][0]['description'] ?>" loading="lazy" width="100" height="100">
                    <p style="margin-bottom: 0;"> <?= $currentWeather['weather'][0]['main'] ?>  </p>
                    <div>
                        <?= $currentWeather['weather'][0]['description'] ?>
                    </div>
                </div>
                <div class="weather-widget-temperature">
                    <p style="margin-bottom: 0"> <?= intval($currentWeather['main']['temp'] - 273.15) ?></p>
                    <p class="feels"> Feels <?= intval($currentWeather['main']['feels_like'] - 273.15) ?> °c </p>
                </div>
            </div>
            <div class="weather-summary-details">
                <div class="ws-details">
                    <div class="ws-details-item">
                        Wind:
                        <span class="wind-speed"><?= $currentWeather['wind']['speed'] ?> m/s</span>
                        <div class="wind-direction">
                            <span class="wind">Gust: <?= $currentWeather['wind']['gust'] ?> m/s</span>
                            <img src="https://www.worldweatheronline.com/staticv150817/assets-202110/img/wind-direction.svg" alt="" class="wind-arrow" style="transform: rotate(<?= $currentWeather['wind']['deg'] ?>deg);" loading="lazy">
                        </div>
                    </div>
                    
                    <div class="ws-details-item">
                        Visibility: <span> <?= number_format($currentWeather['visibility']) ?> m</span>
                    </div>

                    <div class="ws-details-item">
                        Cloud: <span> <?= $currentWeather['clouds']['all'] ?>%</span>
                    </div>

                    <div class="ws-details-item">
                        Humidity: <span> <?= $currentWeather['main']['humidity'] ?>%</span>
                    </div>
                </div>
                <hr class="ws-details-hr">
                <div class="rise-set">

                    <div class="rise">
                        <p> Sunrise: <span> <?= App::formatter()->asDateToTimezone(date('Y-m-d H:i:s A', $currentWeather['sys']['sunrise']), 'h:i A') ?></span> </p>
                        <p> Sea Level: <span> <?= number_format($currentWeather['main']['sea_level']) ?> hPa</span> </p>
                    </div>
                    <div class="set">
                        <p> Sunset: <span> <?= App::formatter()->asDateToTimezone(date('Y-m-d H:i:s A', $currentWeather['sys']['sunset']), 'h:i A') ?></span> </p>
                        <p> Ground Level: <span> <?= number_format($currentWeather['main']['grnd_level']) ?> hPa</span> </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="days-details">
            <table class="days-details-table table">
                <tbody>
                    <tr class="days-details-row">
                        
                        <?php foreach ($currentForecast as $time => $l): ?>
                            <td class="days-details-row-item" style="vertical-align: top;">
                                <div class="weather-hour-item">
                                    <p class="report-text"> 
                                        <?= date('h:i A', strtotime($time)) ?> 
                                    </p>
                                    <img class="br-5" data-toggle="tooltip" src="http://openweathermap.org/img/wn/<?= $l['icon'] ?>@2x.png" alt="<?= $time ?>" title="<?= $time ?>" loading="lazy" width="70" height="70">
                                    <p class="report-text"> <?= $l['temp'] ?> °c </p>
                                </div>
                            </td>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="weather-text">
            General Nakar, Philippines weather forecasted for the next 5 days will have maximum temperature of <?= $sypnosisData['MAX_TEMP_C'] ?>°c / <?= $sypnosisData['MAX_TEMP_F'] ?>°f on <?= $sypnosisData['MAX_TEMP_DATE'] ?>. Min temperature will be <?= $sypnosisData['MIN_TEMP_C'] ?>°c / <?= $sypnosisData['MIN_TEMP_F'] ?>°f on <?= $sypnosisData['MIN_TEMP_DATE'] ?>. Maximum rain volume will be <?= $sypnosisData['MAX_1H_RAIN'] ?>mm for the last 1 hour on <?= $sypnosisData['MAX_1H_RAIN_DATE'] ?> and <?= $sypnosisData['MAX_3H_RAIN'] ?>mm for the last 3 hours on <?= $sypnosisData['MAX_3H_RAIN_DATE'] ?>. Windiest day is expected to see wind of up to <?= $sypnosisData['MAX_WIND'] ?> kmph on <?= $sypnosisData['MAX_WIND_DATE'] ?>. 
        </p>

        <div class="text-muted mt-5"><small>Source: <a href="https://openweathermap.org" target="_blank">openweathermap.org</a></small></div>
    </div>
</div>
 


