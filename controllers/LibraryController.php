<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\models\Library;
use app\models\Refregion;
use app\models\Refprovince;
use app\models\Refcitymun;
use app\models\Refbrgy;
use app\models\search\LibrarySearch;

/**
 * LibraryController implements the CRUD actions for Library model.
 */
class LibraryController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Library::findByKeywords($keywords, [
                'family',
                'genus',
                'species',
                'common_name',
                'taxonomic_group',
                'conservation_status',
                'residency_status',
            ])
        );
    }

    /**
     * Lists all Library models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LibrarySearch();
        $dataProvider = $searchModel->search(['LibrarySearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Library model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Library::controllerFind($id),
        ]);
    }

    /**
     * Creates a new Library model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Library();

        if (($post = App::post()) != null) {
            $post = $this->parseLocation($post);

            if ($model->load($post) && $model->save()) {
                App::success('Successfully Created');
                return $this->redirect($model->viewUrl);
            }
        }
        $model->flashErrors();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Library model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Library::controllerFind($id);
        $model = new Library();
        $model->attributes = $originalModel->attributes;

        if (($post = App::post()) != null) {
            $post = $this->parseLocation($post);

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

    public function locationDecoding($data)
    {
        return is_array($data) ? $data: json_decode($data, true);
    }

    public function parseLocation($post)
    {
        $post['Library']['island_group'] = $this->locationDecoding($post['Library']['island_group']);
        $post['Library']['region'] = $this->locationDecoding($post['Library']['region']);
        $post['Library']['province'] = $this->locationDecoding($post['Library']['province']);
        $post['Library']['municipality'] = $this->locationDecoding($post['Library']['municipality']);
        $post['Library']['brgy'] = $this->locationDecoding($post['Library']['brgy']);
        $post['Library']['location_data'] = $this->locationDecoding($post['Library']['location_data']);

        return $post;
    }

    /**
     * Updates an existing Library model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Library::controllerFind($id);

        if (($post = App::post()) != null) {
            $post = $this->parseLocation($post);

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
     * Deletes an existing Library model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Library::controllerFind($id);

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

    public function actionLocationData($id='', $type='', $node_id='')
    {
        $model = Library::findOrCreate($id);
        $data = [];
        switch ($type) {
            case 'island_group':
                $result = Refregion::dropdown('id', 'regDesc', ['island_group' => $node_id], false);
                foreach ($result as $index => $region) {
                    $data[] = [
                        'text' => $region->regDesc,
                        'type' => 'region',
                        'id' => $region->regCode,
                        'regCode' => $region->regCode,
                        'island_group' => $region->island_group,
                        'children' => true,
                        'data' => ['type' => 'region']
                    ];
                }
                break;

            case 'region':
                $result = Refprovince::dropdown('id', 'provDesc', ['regCode' => $node_id], false);
                foreach ($result as $index => $province) {
                    $data[] = [
                        'text' => $province->provDesc,
                        'type' => 'province',
                        'id' => $province->provCode,
                        'provCode' => $province->provCode,
                        'regCode' => $province->regCode,
                        'children' => true,
                        'data' => ['type' => 'province']
                    ];
                }
                break;

            case 'province':
                $result = Refcitymun::dropdown('id', 'citymunDesc', ['provCode' => $node_id], false);
                foreach ($result as $index => $citymun) {
                    $data[] = [
                        'text' => $citymun->citymunDesc,
                        'type' => 'citymun',
                        'id' => $citymun->citymunCode,
                        'citymunCode' => $citymun->citymunCode,
                        'provCode' => $citymun->provCode,
                        'children' => true,
                        'data' => ['type' => 'citymun']
                    ];
                }
                break;

            case 'citymun':
                $result = Refbrgy::dropdown('id', 'brgyDesc', ['citymunCode' => $node_id], false);
                foreach ($result as $index => $brgy) {
                    $data[] = [
                        'text' => $brgy->brgyDesc,
                        'type' => 'brgy',
                        'id' => $brgy->brgyCode,
                        'brgyCode' => $brgy->brgyCode,
                        'citymunCode' => $brgy->citymunCode,
                        'data' => ['type' => 'brgy']
                    ];
                }
                break;
            
            default:
                $data = $model->location_data ?: Library::LOCATION_DATA;
                break;
        }
        return $this->asJson($data);
    }
}