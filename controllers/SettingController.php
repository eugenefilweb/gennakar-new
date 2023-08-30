<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\models\Budget;
use app\models\Municipality;
use app\models\Province;
use app\models\Setting;
use app\models\Theme;
use app\models\Transaction;
use app\models\form\SettingForm;
use app\models\form\setting\AddressSettingForm;
use app\models\form\setting\DocumentSettingForm;
use app\models\form\setting\EmailSettingForm;
use app\models\form\setting\GeneralSettingForm;
use app\models\form\setting\ImageSettingForm;
use app\models\form\setting\MapSettingForm;
use app\models\form\setting\MobileAppSettingForm;
use app\models\form\setting\NotificationSettingForm;
use app\models\form\setting\PersonnelForm;
use app\models\form\setting\PrioritySectorSettingsForm;
use app\models\form\setting\ReportTemplateForm;
use app\models\form\setting\SystemSettingForm;
use app\models\form\user\MySettingForm;
use app\models\search\SettingSearch;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends Controller
{
    public function actionFindByKeywords($keywords='')
    { 
        return $this->asJson(
            Setting::findByKeywords($keywords, ['name', 'value'])
        );
    }

    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(['SettingSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Setting model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => Setting::controllerFind($slug, 'slug'),
        ]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = Setting::controllerFind($slug, 'slug');

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = Setting::controllerFind($slug, 'slug');

        if($model->delete()) {
            App::success('Successfully Deleted');
        }
        else {
            App::danger(json_encode($model->errors));
        }

        return $this->redirect($model->indexUrl);
    }

    public function actionChangeRecordStatus()
    {
        return $this->changeRecordStatus();
    }

    public function actionBulkAction()
    {
        return $this->bulkAction();
    }

    public function actionPrint()
    {
        return $this->exportPrint();
    }

    public function actionExportPdf()
    {
        return $this->exportPdf();
    }

    public function actionExportCsv()
    {
        return $this->exportCsv();
    }

    // public function _ctionExportXls()
    // {
    //     return $this->exportXls();
    // }

    public function actionExportXlsx()
    {
        return $this->exportXlsx();
    }

    private function prefilledPost($post)
    {
        $attributes = [
            'system_change_password' => 0,
            'email_change_password' => 0,
            'new_patrol' => 0,
            'new_request' => 0,
            'email_approved_request' => 0,
            'approved_request' => 0,
            'new_tech_issue' => 0,
        ];

        foreach ($attributes as $attribute => $value) {
            $post['MySettingForm'][$attribute] = $post['MySettingForm'][$attribute] ?? $value;
        }

        return $post;
    }

    public function actionMySetting()
    {
        if (App::isLogin()) {
            $user = App::identity(); 
            $model = new MySettingForm(['user_id' => $user->id]);
            $model->theme_id = $model->theme_id ?: App::setting('system')->theme;
 
            if (($post = App::post()) != null) {
                $post = $this->prefilledPost($post);

                if ($model->load($post) && $model->save()) {
                    App::success('Settings Updated');
                    return $this->redirect(['my-setting']);
                }
                App::danger(Html::errorSummary($model));
            }

            return $this->render('my-setting', [
                'user' => $user,
                'model' => $model,
                'themes' => Theme::all(),
            ]);
        }
    }

    public function actionGeneral($tab='system')
    {
        switch ($tab) {
            case 'document':
                $model = new DocumentSettingForm();
                break;
                
            case 'system':
                $model = new SystemSettingForm();
                break;

            case 'email':
                $model = new EmailSettingForm();
                break;

            case 'image':
                $model = new ImageSettingForm();
                break;
            
            case 'address':
                $model = new AddressSettingForm();
                break;

            case 'map':
                $model = new MapSettingForm();
                break;

            case 'notification':
                $model = new NotificationSettingForm();
                break;

            case 'mobile-app':
                $model = new MobileAppSettingForm();
                break;
                
            case 'report-template':
                $model = new ReportTemplateForm();
                $model->setData();
                break;

            case 'priority-sector':
                $model = new PrioritySectorSettingsForm();
                break;

            case 'personnel':
                $model = new PersonnelForm();
                break;

            case 'budget':
                $currentYear = date('Y', strtotime(App::formatter()->asDateToTimezone()));
                $year = App::get('year') ?: $currentYear;
                $model = new Budget(['year' => $year]);
                $model->type = Transaction::EMERGENCY_WELFARE_PROGRAM;
                // $model->year = $currentYear;
                break;
            
            default:
                $model = new SystemSettingForm();
                break;
        }

        if ($model->load(App::post())) {
            if ($model->save()) {
                App::success('Successfully Changed');
            }
            else {
                App::danger(Html::errorSummary($model));
            }

            return $this->redirect(['general', 'tab' => $tab]);
        }

        return $this->render('general', [
            'model' => $model,
            'tab' => $tab,
            'templateTab' => App::get('templateTab') ?: 'certificate-of-indigency'
        ]);
    }

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionGetProvinces($region_id)
    {
        return $this->asjson([
            'status' => 'success',
            'models' => Province::dropdown('id', 'name', [
                'region_id' => $region_id
            ])
        ]);
    }

    public function actionGetMunicipalities($province_id)
    {
        return $this->asjson([
            'status' => 'success',
            'models' => Municipality::dropdown('id', 'name', [
                'province_id' => $province_id
            ])
        ]);
    }

    public function actionChangeAlertLevel($alert_level, $purpose = 'changed')
    {
        if ($purpose == 'subscribe') {
            session_write_close();
            ignore_user_abort(false);
            set_time_limit(0);

            $current_alert_level = (App::setting('system'))->alert_level;

            for ($i=0; $i < rand(3, 5); $i++) { 
                $response = [];

                if ((int) $alert_level != (int) $current_alert_level) {
                    $response['status'] = 'success';
                    $response['alert_level'] = App::params('alert_level')[$current_alert_level];
                }

                if ($response) {
                    return $this->asJson($response);
                }
                
                sleep(1);
            }

            return $this->asJson([
                'status' => 'failed',
                'errorSummary' => 'no changes'
            ]);
        }

        $model = new SystemSettingForm();
        $model->alert_level = $alert_level;
        
        if ($model->save()) {
            return $this->asJson([
                'status' => 'success',
            ]);
        }

        return $this->asJson([
            'status' => 'failed',
            'errors' => $model->errors,
            'errorSummary' => Html::errorSummary($model)
        ]);
    }
}