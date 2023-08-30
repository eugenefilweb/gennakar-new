<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\Event;
use app\models\Role;
use app\models\search\DashboardSearch;
use app\widgets\OpenWeatherApi;

class DashboardController extends Controller
{
    public function actionFindByKeywords($keywords='')
    {
        $data = array_merge(
            Event::findByKeywords($keywords, ['name', 'description']),
        );

        $data = array_unique($data);
        $data = array_values($data);
        sort($data);

        return $this->asJson($data);
    }

    public function actionIndex($type = '')
    {
        if ($type == 'weather-refresh') {
            return $this->asJson([
                'weather' => OpenWeatherApi::widget(),
            ]);
        }

        $searchModel = new DashboardSearch();

        if (App::identity('role_id') == Role::REQUEST_APPROVER) {
            return $this->redirect(['request/index']);
        }

        if (($queryParams = App::queryParams()) != null) {
            $dataProviders = $searchModel->search(['DashboardSearch' => $queryParams]);

            if ($searchModel->keywords) {
                return $this->render('search_result', [
                    'dataProviders' => $dataProviders,
                    'searchModel' => $searchModel,
                ]);
            }
            else {
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
        ]);
    }

    public function actionPrintWeather()
    {
        $this->layout = 'print';
        return $this->render('print-weather');
    }
}