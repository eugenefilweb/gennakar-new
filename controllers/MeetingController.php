<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\ActiveRecord;
use app\models\Meeting;
use app\models\search\MeetingSearch;
use yii\helpers\Inflector;

/**
 * MeetingController implements the CRUD actions for Meeting model.
 */
class MeetingController extends Controller 
{
    public function actionFindByKeywords($keywords='', $type = '')
    {
        return $this->asJson(
            Meeting::findByKeywords($keywords, ['name'], 10, [
                'type' => $type
            ])
        );
    }

    /**
     * Lists all Meeting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeetingSearch();
        $dataProvider = $searchModel->search(['MeetingSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['type' => Meeting::TYPE_NORMAL]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSpecial()
    {
        $searchModel = new MeetingSearch([
            'searchLabel' => 'Special Meeting',
            'searchAction' => ['meeting/special']
        ]);
        $dataProvider = $searchModel->search(['MeetingSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['type' => Meeting::TYPE_SPECIAL]);

        return $this->render('special', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meeting model.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        $model = Meeting::controllerFind($slug, 'slug');

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Meeting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type = Meeting::TYPE_NORMAL)
    {
        $model = new Meeting(['type' => $type]);

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
     * Duplicates a new Meeting model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($slug)
    {
        $originalModel = Meeting::controllerFind($slug, 'slug');
        $model = new Meeting();
        $model->attributes = $originalModel->attributes;

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Duplicated');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('duplicate', [
            'model' => $model,
            'originalModel' => $originalModel,
        ]);
    }

    /**
     * Updates an existing Meeting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $slug
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = Meeting::controllerFind($slug, 'slug');

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Meeting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = Meeting::controllerFind($slug, 'slug');

        if($model->delete()) {
            App::success('Successfully Deleted');
        }
        else {
            App::danger(json_encode($model->errors));
        }

        return $this->redirect($model->isSpecial ? ['special']: $model->indexUrl);
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

    public function actionMinutes()
    {
        $searchModel = new MeetingSearch(['searchAction' => ['minutes']]);
        $dataProvider = $searchModel->search(['MeetingSearch' => App::queryParams()]);

        return $this->render('minutes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAttendance()
    {
        $searchModel = new MeetingSearch(['searchAction' => ['attendance']]);
        $dataProvider = $searchModel->search(['MeetingSearch' => App::queryParams()]);

        return $this->render('attendance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResolutions()
    {
        $searchModel = new MeetingSearch(['searchAction' => ['resolutions']]);
        $dataProvider = $searchModel->search(['MeetingSearch' => App::queryParams()]);

        return $this->render('resolutions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPhotos()
    {
        $searchModel = new MeetingSearch(['searchAction' => ['photos']]);
        $dataProvider = $searchModel->search(['MeetingSearch' => App::queryParams()]);

        return $this->render('photos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBulkActionSpecial()
    {
        $model = $this->modelObject();

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

                $models = Meeting::find()
                    ->where(['id' => $post['selection']])
                    ->andFilterWhere($condition)
                    ->all();

                if (!$models) {
                    App::warning(App::formatter()->asImplode($message, '! '));
                    return $this->redirect(['special']);
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

        return $this->redirect(['special']);
    }
}