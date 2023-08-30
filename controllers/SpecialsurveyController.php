<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\Html;
use app\jobs\ImportSurveyJob;
use app\models\BarangayCoordinates;
use app\models\Queue;
use app\models\Specialsurvey;
use app\models\form\SpecialsurveyImportForm;
use app\models\form\export\ExportCsvForm;
use app\models\form\export\ExportExcelForm;
use app\models\form\setting\AddressSettingForm;
use app\models\form\setting\SurveySettingForm;
use app\models\search\SpecialsurveySearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * SpecialsurveyController implements the CRUD actions for Specialsurvey model.
 */
class SpecialsurveyController extends Controller 
{
    public function actionFindByKeywords($keywords='')
    {
        return $this->asJson(
            Specialsurvey::findByKeywords($keywords, [
            	'last_name',  
	            'first_name',  
	            'middle_name',  
	            'age',  
	            'date_of_birth',  
	            'civil_status',  
	            'house_no',  
	            'sitio',  
	            'municipality',  
	            'province',  
	            'religion',  
	            'date_survey',  
	            'remarks',  
	            'house_no',  
	            'survey_name',  
	            'CONCAT_WS(" ", `first_name`,  `last_name`)',  
                'CONCAT_WS(" ", `last_name`,  `first_name`)',  
                'CONCAT_WS(" ", `first_name`, `middle_name`, `last_name`)',  
                'CONCAT_WS(" ", `last_name`, `middle_name`, `first_name`)',  
            ])
        );
    }

    /**
     * Lists all Specialsurvey models.
     * @return mixed
     */
    public function actionIndex()
    {
		$survey_color = Specialsurvey::surveyColorReIndex();
		
		
        $searchModel = new SpecialsurveySearch();
        $dataProvider = $searchModel->search(['SpecialsurveySearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'survey_color'=>$survey_color
        ]);
    }

    /**
     * Displays a single Specialsurvey model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Specialsurvey::controllerFind($id),
        ]);
    }

    /**
     * Creates a new Specialsurvey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Specialsurvey();

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Created');

            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Duplicates a new Specialsurvey model.
     * If duplication is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDuplicate($id)
    {
        $originalModel = Specialsurvey::controllerFind($id);
        $model = new Specialsurvey();
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
     * Updates an existing Specialsurvey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Specialsurvey::controllerFind($id);

        if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionImportcsv()
    {
        $model = new SpecialsurveyImportForm();

        if ($model->load(App::post())) {
            if ($model->validate()) {
                Queue::push(new ImportSurveyJob([
                    'file_token' => $model->file_token,
                    'user_id' => App::identity('id')
                ]));
                App::success('The survey data will be imported in the queue. There will be a system notification once the importation was completed.');
                // App::success('The survey imported successfully.');
            }
            else {
                App::danger(Html::errorSummary($model));
            }

            return $this->redirect(['importcsv']);
        }

        return $this->render('_form_csv', [
            'household' => $household,
            'model' => $model,
        ]);


        /* if ($model->load(Yii::$app->request->post())){

        	$model->csv_file = UploadedFile::getInstances($model, 'csv_file');

        	if($model->csv_file) {
				$get_survey_color = App::setting('surveyColor')->survey_color;
				$survey_colors_id = $get_survey_color?ArrayHelper::index($get_survey_color, 'id'):[];
				$survey_colors_label = $get_survey_color?ArrayHelper::index($get_survey_color, 'label'):[];
				$fp = fopen($model->csv_file[0]->tempName, 'r');

				if($fp) {
					$line = fgetcsv($fp, 1000, ",");
					$first_time = true;

					do {
						if ($first_time == true) {
							$first_time = false;
							continue;
						}
				
						$survey_exist=Specialsurvey::findOne([
							'last_name'=>trim($line[0]),
							'first_name'=>trim($line[1]),
							'middle_name'=>trim($line[2]),  
							'date_of_birth'=>(trim($line[5])?date('Y-m-d', strtotime(trim($line[5])) ):null), 
							'date_survey'=>trim($line[19])
						]);
	
						if($survey_exist) {
							continue;
						}
						else {
							$model_c = new Specialsurvey(); 
						}
	
						$model_c->last_name=trim($line[0]);
						$model_c->first_name=trim($line[1]);
						$model_c->middle_name=trim($line[2]);
						$model_c->gender=trim($line[3]);
						$model_c->age=trim($line[4]);
						$model_c->date_of_birth=trim($line[5])?date('Y-m-d', strtotime(trim($line[5])) ):null;
						$model_c->civil_status=trim($line[6]);
						$model_c->house_no=trim($line[7]);
						$model_c->sitio=trim($line[8]);
						$model_c->purok=trim($line[9]);
						$model_c->barangay=trim($line[10]);
						$model_c->municipality=trim($line[11]);
						$model_c->province=trim($line[12]);
						$model_c->religion=trim($line[13]);
						$model_c->criteria1_color_id=is_numeric(trim($line[14]))?trim($line[14]): $survey_colors_label[ucwords(strtolower(trim($line[14])))]['id'] ;
						$model_c->criteria2_color_id=is_numeric(trim($line[15]))?trim($line[15]): $survey_colors_label[ucwords(strtolower(trim($line[15])))]['id'] ;
						$model_c->criteria3_color_id=is_numeric(trim($line[16]))?trim($line[16]): $survey_colors_label[ucwords(strtolower(trim($line[16])))]['id'] ;
						$model_c->criteria4_color_id=is_numeric(trim($line[17]))?trim($line[17]): $survey_colors_label[ucwords(strtolower(trim($line[17])))]['id'] ;
						$model_c->criteria5_color_id=is_numeric(trim($line[18]))?trim($line[18]): $survey_colors_label[ucwords(strtolower(trim($line[18])))]['id'] ;
						$model_c->date_survey=trim($line[19])?date('Y-m-d', strtotime(trim($line[19])) ):null;
						$model_c->remarks=trim($line[20]);

						$model_c->save();
					}
					while( ($line = fgetcsv($fp, 1000, ",")) != FALSE);
				}
			
				return $this->redirect(['specialsurvey/index']);
			}
		}

		if (Yii::$app->request->isAjax) {
			return $this->renderAjax('_form_csv', [
				'model' => $model,
			]); 
        }

        return $this->render('_form_csv', [
        	'model' => $model,
        ]);*/
    }

    public function actionBarangayCoordinates($criteria = '')
    {
		$survey_color = Specialsurvey::surveyColorReIndex();

		$queryParams = App::queryParams();

		if (isset($queryParams['criteria1_color_id'])) {
			unset($queryParams['criteria1_color_id']);
			$criteria = $criteria ?: 1;
		}
		if (isset($queryParams['criteria2_color_id'])) {
			unset($queryParams['criteria2_color_id']);
			$criteria = $criteria ?: 2;
		}
		if (isset($queryParams['criteria3_color_id'])) {
			unset($queryParams['criteria3_color_id']);
			$criteria = $criteria ?: 3;
		}
		if (isset($queryParams['criteria4_color_id'])) {
			unset($queryParams['criteria4_color_id']);
			$criteria = $criteria ?: 4;
		}
		if (isset($queryParams['criteria5_color_id'])) {
			unset($queryParams['criteria5_color_id']);
			$criteria = $criteria ?: 5;
		}
		$criteria = $criteria ?: 1;
		
        $searchModel = new SpecialsurveySearch();
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => $queryParams]);
		$mdata = $dataProvider->getModels();
		$barangay_data = ArrayHelper::index($mdata, 'barangay');
		$address = App::setting('address'); 
		
		$coordinates = BarangayCoordinates::find()
			->select([
				"country",
				"province",
				"municipality",
				'
				(
					CASE barangay
						when "Poblacion 61" then "Poblacion 61 (Barangay 2)"
						when "Poblacion I" then "Poblacion I (Barangay 1)"
					ELSE 
						barangay
					END
				)
				barangay',
				"coordinates",
				"color"
			])
			->where([
				'municipality' => $address->municipalityName, 
				'province' => $address->provinceName,
			])
			->andFilterWhere([
				'(
					CASE barangay
						when "Poblacion 61" then "Poblacion 61 (Barangay 2)"
						when "Poblacion I" then "Poblacion I (Barangay 1)"
					ELSE 
						barangay
					END
				)' => $searchModel->barangay
			])
			->asArray()
			->all();

		foreach ($coordinates as $key=>$row ) {

			$coordinates = json_decode($row['coordinates'],true);
	
			$total_black = $barangay_data[$row['barangay']]["criteria{$criteria}_color_black"];
			$total_gray = $barangay_data[$row['barangay']]["criteria{$criteria}_color_gray"];
			$total_green = $barangay_data[$row['barangay']]["criteria{$criteria}_color_green"];
			$total_red = $barangay_data[$row['barangay']]["criteria{$criteria}_color_red"];
	 		
	 		$row['color'] = $searchModel->getDominantColor(
	 			$total_black, $total_gray, $total_green, $total_red
	 		);

	 		$household_colors = [];
	 		$array_total = [$total_black, $total_gray, $total_green, $total_red];

	 		foreach (App::setting('surveyColor')->survey_color as $key => $sc) {
	 			$household_colors[] = [
	 				'label' => $sc['label'], 
					'total' => Html::number($array_total[$key]), 
					'color' => $sc['color'], 
	 			];
	 		}

			$features[] = [
				"type" => "Feature",
				"properties" => [
					"barangay" => $row['barangay'],
					"color" => $row['color'],
					"rank" => "7",
					"ascii" => $row['id'],// "71",
					"household" => Html::number(array_sum($array_total)),
					"household_colors" => $household_colors,
					"url_link" => Url::to([
						'specialsurvey/report-per-purok', 
						'barangay' => $row['barangay'],
						'groupPurok' => true
					],true),
				],
				"geometry" => [
				"type" => "Polygon",
				"coordinates" => [$coordinates],
				]
			];
		}
		
		return $this->asJsonNumeric([
			"type" => "FeatureCollection",
			"features" => $features
		]);
    }

	public function actionReportPerBarangay($print=null)
    {
        $searchModel = new SpecialsurveySearch();
		
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => App::queryParams()]);
        $searchModel->searchAction	= ['specialsurvey/report-per-barangay'];	
		
        $rowsummary = $searchModel->getRowSummary($dataProvider);

        if($print) {
			$this->layout = "@app/views/layouts/print";
			return $this->render('report_barangay_print', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
				'rowsummary' => $rowsummary,
	        ]);
		}
		
        return $this->render('report_barangay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'rowsummary' => $rowsummary,
        ]);
    }

    public function actionExportCsvReportPerBarangay()
    {
    	$searchModel = new SpecialsurveySearch();
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => App::queryParams()]);
        $rowsummary = $searchModel->getRowSummary($dataProvider);

        $model = new ExportCsvForm([
            'content' => $this->renderPartial('report_barangay_print', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
				'rowsummary' => $rowsummary,
	        ]),
            'ini_set' => true
        ]);
        return $model->export();
    }
    public function actionExportXlsxReportPerBarangay()
    {
    	$searchModel = new SpecialsurveySearch();
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => App::queryParams()]);
        $rowsummary = $searchModel->getRowSummary($dataProvider);

        $model = new ExportExcelForm([
            'content' => $this->renderPartial('report_barangay_print', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
				'rowsummary' => $rowsummary,
	        ]),
            'ini_set' => true,
            'type' => 'xlsx'
        ]);
        return $model->export();
    }
	
	public function actionReportPerPurok($print=null)
    {
        $searchModel = new SpecialsurveySearch();
		
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => App::queryParams()]);
        $searchModel->searchAction	= ['specialsurvey/report-per-purok'];	


        $rowsummary = $searchModel->getRowSummary($dataProvider);

		if($print) {
			$this->layout = "@app/views/layouts/print";
			return $this->render('report_purok_print', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
				'rowsummary' => $rowsummary,
			]);
		}
		
        return $this->render('report_purok', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'rowsummary'=>$rowsummary,
        ]);
    }

    public function actionExportCsvReportPerPurok()
    {
    	$searchModel = new SpecialsurveySearch();
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => App::queryParams()]);
        $rowsummary = $searchModel->getRowSummary($dataProvider);

        $model = new ExportCsvForm([
            'content' => $this->renderPartial('report_purok_print', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
				'rowsummary' => $rowsummary,
	        ]),
            'ini_set' => true
        ]);
        return $model->export();
    }
    public function actionExportXlsxReportPerPurok()
    {
    	$searchModel = new SpecialsurveySearch();
        $dataProvider = $searchModel->searchsummary(['SpecialsurveySearch' => App::queryParams()]);
        $rowsummary = $searchModel->getRowSummary($dataProvider);

        $model = new ExportExcelForm([
            'content' => $this->renderPartial('report_purok_print', [
	            'searchModel' => $searchModel,
	            'dataProvider' => $dataProvider,
				'rowsummary' => $rowsummary,
	        ]),
            'ini_set' => true,
            'type' => 'xlsx'
        ]);
        return $model->export();
    }




    /**
     * Deletes an existing Specialsurvey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Specialsurvey::controllerFind($id);

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

    /*public function _ctionPrint()
    {
        return $this->exportPrint();
    }

    public function _ctionExportPdf()
    {
        return $this->exportPdf();
    }*/

    public function actionExportCsv()
    {
        return $this->exportCsv();
    }

    /*public function _actionExportXls()
    {
        return $this->exportXls();
    }*/

    public function actionExportXlsx()
    {
        return $this->exportXlsx();
    }

    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionSettings()
    {
    	$model = new SurveySettingForm();

    	if ($model->load(App::post()) && $model->save()) {
            App::success('Successfully Updated');

            return $this->redirect(['settings']);
        }

        return $this->render('settings', [
            'model' => $model,
        ]);
    }

    public function actionValidateFile($file_token='')
    {
        $model = new SpecialsurveyImportForm([
            'scenario' => 'contentValidation',
            'file_token' => $file_token
        ]);
        if ($model->validate()) {
            return $this->asJson([
                'status' => 'success',
                'message' => 'Valid'
            ]);
        }
        else {
            return $this->asJson([
                'status' => 'failed',
                'errorSummary' => Html::errorSummary($model)
            ]);
        }
    }
}