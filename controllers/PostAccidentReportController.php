<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\PostAccidentReport;
use app\models\search\PostAccidentReportSearch;

/**
 * PostAccidentReportController implements the CRUD actions for PostAccidentReport model.
 */
class PostAccidentReportController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            PostAccidentReport::findByKeywords($keywords, [
                'control_no',
                'location',
                'prepared_by',
                'verified_by',
                'comments_by',
                'officer_in_charge',
                'noted_by',
                'code',
            ])
        );
    }

    /**
     * Lists all PostAccidentReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostAccidentReportSearch();
        $dataProvider = $searchModel->search(['PostAccidentReportSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PostAccidentReport model.
     * @param integer $control_no
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($control_no)
    {
        return $this->render('view', [
            'model' => PostAccidentReport::controllerFind($control_no, 'control_no'),
        ]);
    }

    /**
     * Creates a new PostAccidentReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostAccidentReport();
        $model->setInitData();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        $model->flashErrors();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new PostAccidentReport model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($control_no)
    {
        $originalModel = PostAccidentReport::controllerFind($control_no, 'control_no');
        $model = new PostAccidentReport();
        $model->attributes = $originalModel->attributes;

        if (($post = App::post()) != null) {
            $par = $post['PostAccidentReport'];

            $post['PostAccidentReport']['persons_of_interest'] = $par['persons_of_interest'] ?? null;
            $post['PostAccidentReport']['responders'] = $par['responders'] ?? null;
            $post['PostAccidentReport']['witnesses'] = $par['witnesses'] ?? null;

            if ($model->load($post) && $model->save()) {
                App::success('Successfully Duplicated');
                return $this->redirect($model->viewUrl);
            }
        }

        $model->flashErrors();

        return $this->render('duplicate', [
            'model' => $model,
            'originalModel' => $originalModel,
        ]);
    }

    /**
     * Updates an existing PostAccidentReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $control_no
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($control_no)
    {
        $model = PostAccidentReport::controllerFind($control_no, 'control_no');

        if (($post = App::post()) != null) {
            $par = $post['PostAccidentReport'];

            $post['PostAccidentReport']['persons_of_interest'] = $par['persons_of_interest'] ?? null;
            $post['PostAccidentReport']['responders'] = $par['responders'] ?? null;
            $post['PostAccidentReport']['witnesses'] = $par['witnesses'] ?? null;

            if ($model->load($post) && $model->save()) {
                App::success('Successfully Updated');
                return $this->redirect($model->viewUrl);
            }
        }

        $model->flashErrors();

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PostAccidentReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $control_no
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($control_no)
    {
        $model = PostAccidentReport::controllerFind($control_no, 'control_no');

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

    public function actionExportXls()
    {
        return $this->exportXls();
    }

    public function actionExportXlsx()
    {
        return $this->exportXlsx();
    }

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionPrintable($control_no)
    {
        $this->layout  = 'print';
        return $this->render('printable', [
            'model' => PostAccidentReport::controllerFind($control_no, 'control_no'),
        ]);
    }
}