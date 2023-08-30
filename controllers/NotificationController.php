<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\models\Notification;
use app\models\search\NotificationSearch;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Notification::findByKeywords($keywords, ['message'])
        );
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(['NotificationSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($token)
    {
        $model = Notification::controllerFind($token, 'token');
        $model->setToRead();
        $model->save();

        return $this->redirect($model->link);
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $token
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($token)
    {
        $model = Notification::controllerFind($token, 'token');

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

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionLoad()
    {
        session_write_close();
        ignore_user_abort(false);
        set_time_limit(0);

        try {
            $noChanges = true;
            $trial = rand(5, 10);

            while($noChanges) {
                if ($trial == 0) {
                    $response['status'] = 'failed';
                    $response['errorSummary'] = 'no changes';
                    $noChanges = false;
                    return $this->asJson($response);
                    break;
                }

                $total = Notification::totalUnread();
                $stateNotification = App::post('stateNotification');

                if ((int)$stateNotification != $total) {
                    $notifications = Notification::unread();
                    $noChanges = false;

                    return $this->asJson([
                        'status' => 'success',
                        'stateNotification' => $total ?: 0,
                        'badge' => $total ? 
                            Html::tag('label', $total, [
                                'class' => 'badge badge-danger badge-pill notification-badge'
                            ]): '',
                        'rows' => $this->renderPartial('_row', [
                            'notifications' => $notifications
                        ])
                    ]);
                }

                if ($noChanges == false) {
                    $response['status'] = 'success';

                    return $this->asJson($response);
                    break;
                }

                $trial--;

                sleep(2);
            }
        } 
        catch (\yii\base\ErrorException $e) {
            return $this->asJson([
                'status' => 'failed',
                'errorSummary' => $e->message
            ]);
        }

        $total = Notification::totalUnread();
    }

    public function actionLoadAll()
    {
        $total = Notification::totalUnread();
        $notifications = Notification::unread();

        return $this->asJson([
            'badge' => $total ? Html::tag('label', $total, ['class' => 'badge badge-danger badge-pill notification-badge']): '',
            'rows' => $this->renderPartial('_row', ['notifications' => $notifications ])
        ]);
    }

    public function actionReadAll()
    {
        Notification::readAll(['user_id' => App::identity('id')]);
        // return $this->redirect
    }
}