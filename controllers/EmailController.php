<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\models\Email;
use app\models\form\BulkEmailForm;
use app\models\search\EmailSearch;

/**
 * EmailController implements the CRUD actions for Email model.
 */
class EmailController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Email::findByKeywords($keywords, ['subject', 'to', 'from_email'])
        );
    }

    /**
     * Lists all Email models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailSearch();
        $dataProvider = $searchModel->search(['EmailSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Email model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Email::controllerFind($id);

        if (App::isAjax()) {
            return $this->asJson([
                'status' => 'success',
                'model' => $model,
                'detailView' => $this->renderPartial('_detail', [
                    'model' => $model
                ])
            ]);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
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

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionAlertLevel()
    {
        $model = new BulkEmailForm();

        if (($post = App::post()) != null) {
            if ($model->load($post) && $model->send()) {
                App::success('Email sent...');
            }
            else {
                App::danger(Html::errorSummary($model));
            }
            return $this->redirect(['alert-level']);
        }

        $searchModel = new EmailSearch(['searchAction' => ['email/alert-level']]);
        $dataProvider = $searchModel->search(['EmailSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['created_by' => App::identity('id')]);

        return $this->render('alert-level', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}