<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\models\ActiveRecord;
use app\models\form\export\ExportCsvForm;
use app\models\form\export\ExportExcelForm;
use app\models\form\export\ExportPdfForm;
use app\widgets\ActiveForm;
use app\widgets\ExportContent;
use yii\helpers\Inflector;
use yii\web\Response;

/**
 * RoleController implements the CRUD actions for Role model.
 */
abstract class Controller extends \yii\web\Controller
{
    /*public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }*/

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        App::view()->params['controllerLink'] = Url::toRoute(["{$this->owner->id}/index"]);
        
        switch ($action->id) {
            case 'print':
                $this->layout = 'print';
                break;
            
            default:
                // code...
                break;
        }

        return true;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['ThemeFilter'] = ['class' => 'app\filters\ThemeFilter'];
        $behaviors['UserFilter'] = ['class' => 'app\filters\UserFilter'];
        $behaviors['IpFilter'] = ['class' => 'app\filters\IpFilter'];
        $behaviors['VerbFilter'] = ['class' => 'app\filters\VerbFilter'];
        $behaviors['AccessControl'] = ['class' => 'app\filters\AccessControl'];
        $behaviors['SettingFilter'] = ['class' => 'app\filters\SettingFilter'];

        if (App::setting('system')->enable_visitor) {
            $behaviors['VisitorFilter'] = [
                'class' => 'app\filters\VisitorFilter'
            ];
        }

        return $behaviors;
    }

    public function exportPrint($searchModel='')
    {
        $searchModel = $searchModel ?: $this->searchModelObject();
        return $this->render('/layouts/_print', [
            'content' => ExportContent::widget([
                'file' => 'print',
                'searchModel' => $searchModel,
            ])
        ]);
    }

    public function exportPdf($searchModel='')
    {
        $searchModel = $searchModel ?: $this->searchModelObject();
        $model = new ExportPdfForm([
            'content' => ExportContent::widget([
                'file' => 'pdf',
                'searchModel' => $searchModel,
            ])
        ]);
        return $model->export();
    }

    public function exportCsv($searchModel='')
    {
        $searchModel = $searchModel ?: $this->searchModelObject();
        $model = new ExportCsvForm([
            'content' => ExportContent::widget([
                'file' => 'excel',
                'searchModel' => $searchModel
            ]),
        ]);
        return $model->export();
    }

    public function exportXlsx($searchModel='')
    {
        $searchModel = $searchModel ?: $this->searchModelObject();
        $model = new ExportExcelForm([
            'content' => ExportContent::widget([
                'file' => 'excel',
                'searchModel' => $searchModel
            ]), 
            'type' => 'xlsx'
        ]);
        return $model->export();
    }

    public function exportXls($searchModel='')
    {
        $searchModel = $searchModel ?: $this->searchModelObject();
        $model = new ExportExcelForm([
            'content' => ExportContent::widget([
                'file' => 'excel',
                'searchModel' => $searchModel
            ]), 
            'type' => 'xls'
        ]);
        return $model->export();
    }

    protected function modelObject()
    {
        $class = substr(App::className($this), 0, -10);
        return Yii::createObject("app\\models\\{$class}");
    }

    protected function searchModelObject()
    {
        $class = substr(App::className($this), 0, -10);
        $searchModel = Yii::createObject("app\\models\\search\\{$class}Search");

        $searchModel->load(["{$class}Search" => App::queryParams()]);

        return $searchModel;
    }

    public function changeRecordStatus($function='', $attribute='record_status')
    {
        if (($post = App::post()) != null) {

            if (! $function) {
                $obj = $this->modelObject();
                $model = $obj::controllerFind($post['id']);
            }
            else {
                $model = call_user_func($function, $post['id']);
            }

            if (!$model) {
                return $this->asJson([
                    'status' => 'failed',
                    'errors' => 'No data found.',
                    'errorSummary' => 'No data found.'
                ]);
            }

            $model->{$attribute} = $post['record_status'];

            if ($model->save()) {
                $model->refresh();
                return $this->asJson([
                    'status' => 'success',
                    'attributes' => $model->attributes
                ]);
            }
            else {
                return $this->asJson([
                    'status' => 'failed',
                    'errors' => $model->errors,
                    'errorSummary' => $model->errorSummary
                ]);
            }
        }
    }

    public function actionFindByKeywords($keywords='')
    {
        $data = [];

        return $this->asJson($data);
    }

    public function bulkAction($model='')
    {
        $model = $model ?: $this->modelObject();

        $post = App::post();

        if (isset($post['process-selected'])) {
            $process = Inflector::humanize($post['process-selected']);
            if (isset($post['selection'])) {

                $condition = [];
                $message[] = 'No data found';

                if ($post['process-selected'] == 'active') {
                    $condition['record_status'] = ActiveRecord::RECORD_INACTIVE;
                    $message[] = 'Records are already Active';
                }

                if ($post['process-selected'] == 'in_active') {
                    $condition['record_status'] = ActiveRecord::RECORD_ACTIVE;
                    $message[] = 'Records are already In-active';
                }

                $models = $model::find()
                    ->where(['id' => $post['selection']])
                    ->andFilterWhere($condition)
                    ->all();

                if (!$models) {
                    App::warning(App::formatter()->asImplode($message, '! '));
                    return $this->redirect($model->indexUrl);
                }

                if (isset($post['confirm_button'])) {
                    foreach ($model->bulkActions as $postAction => $action) {
                        if ($action['process'] == $post['process-selected']) {
                            call_user_func($action['function'], $post['selection']);
                        }
                    }
                    App::success("Process successfully completed.");  
                }
                else {
                    return $this->render('bulk-action', [
                        'model' => $model,
                        'models' => $models,
                        'process' => $process,
                        'post' => $post
                    ]);
                }
            }
            else {
                App::warning('No Checkbox Selected');
            }
        }
        else {
            App::warning('No Process Selected');
        }

        return $this->redirect($model->indexUrl);
    }

    public function _ajaxCreated($model)
    {
        $model->refresh();
        $response['status'] = 'success';
        $response['model'] = $model;

        return $this->asJson($response);
    }

    public function _ajaxValidate($model)
    {
        if ($model->load(App::post())) {
            return $this->asJson(ActiveForm::validate($model));
        }
    }

    public function _ajaxForm($model, $template='_form-ajax', $params=[])
    {
        $response['status'] = ($model->errors)? 'failed': 'success';
        $response['errors'] = $model->errors;
        $response['errorSummary'] = Html::errorSummary($model);
        $response['model'] = $model;

        $params['model'] = $model;
        $response['form'] = $this->renderAjax($template, $params);

        return $this->asJson($response);
    }

    public function asJsonNumeric($data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->formatters = [
            \yii\web\Response::FORMAT_JSON => [
                'class' => 'yii\web\JsonResponseFormatter',
                'encodeOptions' => JSON_NUMERIC_CHECK
            ],
        ];
        return $data;
    }

    public function redirectReferrer()
    {
        return $this->redirect(App::referrer());
    }
}