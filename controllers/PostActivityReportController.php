<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\PostActivityReport;
use app\models\search\PostActivityReportSearch;

/**
 * PostActivityReportController implements the CRUD actions for PostActivityReport model.
 */
class PostActivityReportController extends Controller 
{
    public function actionFindByKeywords($keywords='', $type=null)
    {
        return $this->asJson(
            PostActivityReport::findByKeywords($keywords, [
                'control_no',
                'name',
                'location',
                'type_of_activity',
                'in_charge_of_activity'
            ], 10, [
                'type' => $type
            ])
        );
    }

    /**
     * Lists all PostActivityReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostActivityReportSearch();
        $dataProvider = $searchModel->search(['PostActivityReportSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PostActivityReport model.
     * @param integer $control_no
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($control_no)
    {
        return $this->render('view', [
            'model' => PostActivityReport::controllerFind($control_no, 'control_no'),
        ]);
    }

    /**
     * Creates a new PostActivityReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type='')
    {
        if ($type == '') {
            return $this->redirect(['create', 'type' => PostActivityReport::TYPE_SIAD]);
        }
        $model = new PostActivityReport([
            'type' => $type,
            'noted_by' => 'Eliseo Ruzol'
        ]);
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
     * Duplicates a new PostActivityReport model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($control_no)
    {
        $originalModel = PostActivityReport::controllerFind($control_no, 'control_no');
        $model = new PostActivityReport();
        $model->attributes = $originalModel->attributes;

        if (($post = App::post()) != null) {
            $par = $post['PostActivityReport'];

            $post['PostActivityReport']['coordinators'] = $par['coordinators'] ?? null;
            $post['PostActivityReport']['staff_members'] = $par['staff_members'] ?? null;
            $post['PostActivityReport']['other_members'] = $par['other_members'] ?? null;

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
     * Updates an existing PostActivityReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $control_no
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($control_no)
    {
        $model = PostActivityReport::controllerFind($control_no, 'control_no');

        if (($post = App::post()) != null) {
            $par = $post['PostActivityReport'];

            $post['PostActivityReport']['coordinators'] = $par['coordinators'] ?? null;
            $post['PostActivityReport']['staff_members'] = $par['staff_members'] ?? null;
            $post['PostActivityReport']['other_members'] = $par['other_members'] ?? null;

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
     * Deletes an existing PostActivityReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $control_no
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($control_no)
    {
        $model = PostActivityReport::controllerFind($control_no, 'control_no');

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

    public function actionIndex2()
    {
        return $this->render('index-list');
    }
    
    public function actionView2($token='IJiAgnKyt3-1662616014', $id='')
    {
        if ($id) {
            $model = \app\models\Event::findOne($id);
            $model = $model ?: \app\models\Event::find()->one();
            return $this->asJson([
                'status' => 'success',
                'link' => \app\widgets\Anchor::widget([
                    'title' => 'View Event',
                    'link' => $model->viewUrl,
                    'text' => true,
                    'options' => [
                        'target' => '_blank',
                        'class' => 'btn btn-light-primary btn-sm font-weight-bolder'
                    ]
                ]),
                'detail' => $model->detailView
            ]);
        }

        // $model = \app\models\Event::controllerFind($token, 'token');
            $model =  \app\models\Event::find()->one();

        if ($model->category_type == \app\models\Event::SOCIAL_PENSION_CATEGORY) {
            return $this->redirect(['social-pension-event/view', 'token' => $model->token]);
        }

        $tab = App::get('tab') ?: 'unclaim';

        $data = $model->beneficiaries(App::queryParams());
        $claimed = $model->claimed(App::queryParams());

        $u_searchModel = $data['searchModel'];
        $u_searchModel->setAge(['event_id' => $model->id]);
        $u_dataProvider = $data['dataProvider'];

        $c_searchModel = $claimed['searchModel'];
        $c_searchModel->setAge(['event_id' => $model->id]);
        $c_dataProvider = $claimed['dataProvider'];

        return $this->render('index', [
            'model' => $model,
            'tab' => $tab,
            'unclaimClass' => ($tab == 'unclaim')? 'active': '',
            'claimClass' => ($tab == 'claimed')? 'active': '',
            'u_searchModel' => $u_searchModel,
            'u_dataProvider' => $u_dataProvider,
            'c_searchModel' => $c_searchModel,
            'c_dataProvider' => $c_dataProvider,
        ]);
    }

    public function actionPrintable($control_no)
    {
        $this->layout  = 'print';
        return $this->render('printable', [
            'model' => PostActivityReport::controllerFind($control_no, 'control_no'),
        ]);
    }

    public function actionMdrrmo()
    {
        $searchModel = new PostActivityReportSearch(['type' => PostActivityReport::TYPE_DRRM]);
        $searchModel->searchLabel = 'MDRRMO Post Activity Report';
        $searchModel->searchAction = ['mdrrmo'];
        $dataProvider = $searchModel->search(['PostActivityReportSearch' => App::queryParams()]);

        return $this->render('mdrrmo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSiad()
    {
        $searchModel = new PostActivityReportSearch(['type' => PostActivityReport::TYPE_SIAD]);
        $searchModel->searchLabel = 'SIAD Post Activity Report';
        $searchModel->searchAction = ['siad'];
        $dataProvider = $searchModel->search(['PostActivityReportSearch' => App::queryParams()]);

        return $this->render('siad', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}