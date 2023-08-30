<?php

use app\helpers\Html;

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
        margin-right: 104px;
    }
    #{$widgetId} .weather-widget-icon {
        margin-right: 22px;
    }
    #{$widgetId} .weather-widget-temperature {
        font-size: 80px;
        line-height: 69px;
        letter-spacing: -.065em;
        color: #222;
    }
    #{$widgetId} .weather-summary-details {
        flex-grow: 1;
        flex-wrap: wrap;
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
        margin-top: 21px;
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
        margin-bottom: 10px;
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
        padding-top: 18px;
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

$now = $data['data']->current_condition[0];
$first = $data['data']->weather[0];

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
                    <img class="br-10 img-fluid" src="<?= $now->weatherIconUrl[0]->value ?>" alt="<?= $now->weatherDesc[0]->value ?>" title="<?= $now->weatherDesc[0]->value ?>" loading="lazy" width="100" height="100">
                    <p> <?= $now->weatherDesc[0]->value ?> </p>
                </div>
                <div class="weather-widget-temperature">
                    <p> <?= $now->temp_C ?> </p>
                    <p class="feels"> Feels <?= $now->FeelsLikeC ?> °c </p>
                </div>
            </div>
            <div class="weather-summary-details">
                <div class="ws-details">
                    <div class="ws-details-item">
                        Wind:
                        <span class="wind-speed"><?= $now->windspeedKmph ?> km/h</span>
                        <div class="wind-direction">
                            <span class="wind"><?= $now->winddir16Point ?></span>
                            <img src="https://www.worldweatheronline.com/staticv150817/assets-202110/img/wind-direction.svg" alt="" class="wind-arrow" style="transform: rotate(<?= $now->winddirDegree ?>deg);" loading="lazy">
                        </div>
                    </div>
                    <div class="ws-details-item">
                        Rain: <span> <?= $now->precipMM ?> mm</span>
                    </div>
                    <div class="ws-details-item">
                        Cloud: <span> <?= $now->cloudcover ?>%</span>
                    </div>
                    <div class="ws-details-item">
                        Humidity: <span> <?= $now->humidity ?>%</span>
                    </div>
                </div>
                <hr class="ws-details-hr">
                <div class="rise-set">
                    <div class="rise">
                        <p> Sunrise: <span> <?= $first->astronomy[0]->sunrise ?></span> </p>
                        <p> Moonrise: <span> <?= $first->astronomy[0]->moonrise ?></span> </p>
                        <p> Phase: <span><?= $first->astronomy[0]->moon_phase ?></span></p>
                    </div>
                    <div class="set">
                        <p> Sunset: <span> <?= $first->astronomy[0]->sunset ?></span> </p>
                        <p> Moonset: <span> <?= $first->astronomy[0]->moonset ?></span> </p>
                        <p> Illum: <span> <?= $first->astronomy[0]->moon_illumination ?></span> </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="days-details">
            <table class="days-details-table table">
                <tbody>
                    <tr class="days-details-row">
                        <?php foreach ($first->hourly as $key => $hour): ?>
                            <td class="days-details-row-item" style="width:75px;">
                                <div class="weather-hour-item">
                                    <p class="report-text">
                                        <?= Html::convert_army_to_regular($hour->time) ?>
                                    </p>
                                    <img class="br-5" src="<?= $hour->weatherIconUrl[0]->value ?>" alt="<?= $hour->weatherDesc[0]->value ?>" width="48" height="48" loading="lazy">
                                    <p class="report-text"><?= $hour->tempC ?> °c</p>
                                </div>
                            </td>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="weather-text">
            General Nakar, Philippines weather forecasted for the next <?= $days ?> days will have maximum temperature of <?= $maxTempArr->maxtempC ?>°c / <?= $maxTempArr->maxtempF ?>°f on <?= date('D d', strtotime($maxTempArr->date)) ?>. Min temperature will be <?= $minTempArr->maxtempC ?>°c / <?= $minTempArr->maxtempF ?>°f on <?= date('D d', strtotime($minTempArr->date)) ?>. Most precipitation falling will be <?= $maxPrecipMM->precipMM ?> mm / <?= $maxPrecipMM->precipInches ?> inch on <?= date('D d', strtotime($maxPrecipMM->date)) ?>. Windiest day is expected to see wind of up to <?= $maxWind->windspeedKmph ?> kmph / <?= $maxWind->windspeedMiles ?> mph on <?= date('D d', strtotime($maxWind->date)) ?>. Visit <a href="https://www.worldweatheronline.com/general-nakar-weather/quezon/ph.aspx?day=20&amp;tp=3" title="General Nakar, Philippines weather 3 hourly">3 Hourly</a>, <a href="https://www.worldweatheronline.com/general-nakar-weather/quezon/ph.aspx?day=20&amp;tp=1" title="General Nakar, Philippines weather hourly">Hourly</a> and <a href="https://www.worldweatheronline.com/general-nakar-weather-history/quezon/ph.aspx" title="General Nakar, Philippines past weather">Historical</a> section to get in-depth weather forecast information for General Nakar, Philippines.
        </p>
    </div>
</div>

<?php if ($withNextDays): ?>
    
<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
    'title' => 'Next 14 Days Weather'
]) ?>
    <div class="accordion accordion-toggle-arrow accordion-solid" id="accordionExample1">
        <?php foreach($weather as $key => $val): ?>
            <div class="card">
                <div class="card-header">
                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne1-<?= $key ?>">
                        <?= date('F d, Y', strtotime($val->date)) ?>
                    </div>
                </div>
                <div id="collapseOne1-<?= $key ?>" class="collapse <?= ($key == 0)? 'show': '' ?>" data-parent="#accordionExample1">
                    <div class="card-body">
                        <div class="text-dark-50 line-height-lg">
                            <div> <b>Astronomy:</b> 
                                <ul>
                                    <li>Sunrise: <?= $val->astronomy[0]->sunrise ?></li>
                                    <li>Sunset: <?= $val->astronomy[0]->sunset ?></li>
                                    <li>Moonrise: <?= $val->astronomy[0]->moonrise ?></li>
                                    <li>Moonset: <?= $val->astronomy[0]->moonset ?></li>
                                </ul>
                            </div>
                            <div> <b>Max Temperature:</b> <?= $val->maxtempC ?> °C (<?= $val->maxtempF ?> °F) </div>
                            <div> <b>Min Temperature:</b> <?= $val->mintempC ?> °C (<?= $val->mintempF ?> °F) </div>
                            <div> <b>Hourly:</b> 
                                <table class="table table-bordered">
                                    <thead>
                                        <th>time</th>
                                        <th>temperature</th>
                                        <th>wind</th>
                                        <th>weather</th>
                                        <th>chances</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($val->hourly as $key => $hour): ?>
                                            <tr>
                                                <td>
                                                    <?= Html::convert_army_to_regular($hour->time) ?>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <b>Temparature:</b> 
                                                            <?= $hour->tempC ?> °C (<?= $hour->tempF ?> °F)
                                                        </li>
                                                        <li>
                                                            <b>Heat Index: </b> 
                                                            <?= $hour->HeatIndexC ?> °C (<?= $hour->HeatIndexF ?> °F)
                                                        </li>
                                                        <li>
                                                            <b>Dew Point:</b> 
                                                            <?= $hour->DewPointC ?> °C (<?= $hour->DewPointF ?> °F)
                                                        </li>
                                                        <li>
                                                            <b>Feels Like: </b> 
                                                            <?= $hour->FeelsLikeC ?> °C (<?= $hour->FeelsLikeF ?> °F)
                                                        </li>
                                                        <li>
                                                            <b>UV Index: </b> 
                                                            <?= $hour->uvIndex ?>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <b>Speed:</b> 
                                                            <?= $hour->windspeedMiles ?> miles/hour  (<?= $hour->windspeedKmph ?> KMPH)
                                                        </li>
                                                        <li>
                                                            <b>Direction:</b> 
                                                            <?= $hour->winddirDegree ?> Degree (<?= $hour->winddir16Point ?>)
                                                        </li>

                                                        <li>
                                                            <b>WindChill:</b> 
                                                            <?= $hour->WindChillC ?> °C (<?= $hour->WindChillF ?> °F)
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <img src="<?= $hour->weatherIconUrl[0]->value ?>" style="border-radius: 50px;">
                                                        </div>
                                                        <div>
                                                            <div class="ml-2">
                                                                <?= $hour->weatherDesc[0]->value ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <b>Rain:</b> <?= $hour->chanceofrain ?> %
                                                        </li>
                                                        <li>
                                                            <b>Dry:</b> <?= $hour->chanceofremdry ?> %
                                                        </li>
                                                        <li>
                                                            <b>Windy:</b> <?= $hour->chanceofwindy ?> %
                                                        </li>
                                                        <li>
                                                            <b>Overcast:</b> <?= $hour->chanceofovercast ?> %
                                                        </li>
                                                        <li>
                                                            <b>Sunshine:</b> <?= $hour->chanceofsunshine ?> %
                                                        </li>
                                                        <li>
                                                            <b>Frost:</b> <?= $hour->chanceoffrost ?> %
                                                        </li>
                                                        <li>
                                                            <b>High Temperature:</b> <?= $hour->chanceofhightemp ?> %
                                                        </li>
                                                        <li>
                                                            <b>Fog:</b> <?= $hour->chanceoffog ?> %
                                                        </li>
                                                        <li>
                                                            <b>Snow:</b> <?= $hour->chanceofsnow ?> %
                                                        </li>
                                                        <li>
                                                            <b>Thunder:</b> <?= $hour->chanceofthunder ?> %
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php $this->endContent() ?>
    
<?php endif ?>






