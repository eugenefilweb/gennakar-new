<?php

namespace app\controllers;

use Yii;
use app\helpers\App;
use app\helpers\ArrayHelper;
use app\helpers\FileHelper;
use app\helpers\Html;
use app\models\File;
use app\models\form\FileForm;
use app\models\form\SpreadsheetReaderForm;
use app\models\form\UploadForm;
use app\models\search\FileSearch;
use app\widgets\ActiveForm;
use yii\web\UploadedFile;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
{
    public function actionFindByKeywords($keywords='', $tag='')
    {
        return $this->asJson(
            File::findByKeywords($keywords, ['name', 'tag', 'extension'], 10, [
                'tag' => $tag
            ])
        );
    }

    public function actionFindByKeywordsImage($keywords='')
    {
        return $this->asJson(
            File::findByKeywordsImage($keywords, ['name', 'tag', 'extension', 'token'])
        );
    }
     
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['AccessControl'] = [
            'class' => 'app\filters\AccessControl',
            'publicActions' => ['display', 'upload', 'download', 'viewer', 'advanced-edit', 'draw']
        ];

        if (App::isAction('display')) {
            unset(
                $behaviors['UserFilter'],
                $behaviors['ThemeFilter'],
                $behaviors['SettingFilter'],
            );
        }

        return $behaviors;
    }
    
    public function actionDisplay($token='')
    {
        $w = App::get('w') ?: '';
        $h = App::get('h') ?: '';
        $crop = App::get('crop') ?: 'false';
        $ratio = App::get('ratio') ?: 'true';
        $quality = App::get('quality') ?: 100;
        $rotate = App::get('rotate') ?: 0;
        $extension = App::get('extension') ?: 'png';

        $file = File::findByToken($token) ?: File::findByToken(App::setting('image')->image_holder);

        if ($file && $file->exists) {
            $w = ($w)? (int)$w: $file->width;
            $h = ($h)? (int)$h: $file->height;

            if ($ratio == 'true') {
                return $file->getImageRatio($w, $quality, $extension, $rotate);
            }
            elseif ($crop == 'true') {
                return $file->getImageCrop($w, $h, $quality, $extension, $rotate);
            }
            else {
                return $file->getImage($w, $h, $quality, $extension, $rotate);
            }
        }

        return File::IMAGE_HOLDER;
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(['FileSearch' => App::queryParams()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($token, $template='view')
    {
        $model = File::controllerFind($token, 'token');

        if (App::isAjax()) {
            return $this->asJson([
                'status' => 'success',
                'form' => $this->renderAjax($template, [
                    'model' => $model,
                ])
            ]);
        }

        return $this->render($template, [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionDelete($token = '')
    {
        $model = File::controllerFind($token, 'token');

        if (App::isAjax()) {
            if ($model && $model->canDelete) {
                $file = $model;
                if ($model->delete()) {
                    return $this->asJson([
                        'total_by_tag' => $file->totalByTag,
                        'status' => 'success',
                        'file' => $file,
                        'message' => 'File Deleted'
                    ]);
                }

                return $this->asJson([
                    'status' => 'failed',
                    'errors' => $model->errorSummary
                ]);
            }

            return $this->asJson([
                'status' => 'failed',
                'errors' => 'File not found or file cannot be deleted'
            ]);
        }

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

    public function actionUpload($w=200)
    {
        if (($post = App::post()) != null) {
            $model = new UploadForm();
            if ($model->load($post)) {

                $model->fileInput = UploadedFile::getInstance($model, 'fileInput');
                if (($file = $model->upload()) != false) {
                    $file->refresh();

                    $result['status'] = 'success';
                    $result['message'] = 'Uploaded';
                    $result['src'] = $file->getUrlImage(['w' => $w]);
                    $result['post'] = $post;
                    $result['file'] = $file;
                    $result['total_by_tag'] = $file->totalByTag;
                    $result['row'] = $this->renderPartial('/file/_row', [
                        'model' => $file
                    ]);
                    $result['_rowFilename'] = $this->renderPartial('/file/_row-filename', [
                        'model' => $file
                    ]);
                    $result['_rowActions'] = $this->renderPartial('/file/_row-actions', [
                        'model' => $file
                    ]);
                }
                else {
                    $result['status'] = 'error';
                    $result['message'] = json_encode($model->errors);
                    $result['errors'] = $model->errors;
                }
            }
            else {
                $result['status'] = 'error';
                $result['message'] = 'Form not valid';
            }
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'no form data';
        }

        return $this->asJson($result);
    }

    public function actionDownload($token)
    {
        $model = File::controllerFind($token, 'token');
        if ($model->download()) {
            
        }
        else {
            App::warning('File don\'t exist');
            return $this->redirect(App::referrer());
        }
    }
 
    public function actionInActiveData()
    {
        # dont delete; use in condition if user has access to in-active data
    }

    public function actionMyImageFiles()
    {
        $searchModel = new FileSearch([
            'extension' => File::EXTENSIONS['image'],
            // 'created_by' => App::identity('id')
        ]);

        $searchModel->pagination = 12;
        $dataProvider = $searchModel->search(['FileSearch' => App::queryParams()]);
        $dataProvider->query->groupBy(['name', 'size', 'extension']);

        $data = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

        if (App::isAjax()) {
            return $this->renderPartial('my-image-files-ajax', $data);
        }


        return $this->render('my-image-files', $data); 
    }

    public function actionMyFiles()
    {
        $searchModel = new FileSearch([
            'created_by' => App::identity('id')
        ]);

        $searchModel->pagination = 12;
        $dataProvider = $searchModel->search(['FileSearch' => App::queryParams()]);
        $dataProvider->query->groupBy(['name', 'size', 'extension']);

        $data = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => new FileForm()
        ];

        if (App::isAjax()) {
            return $this->renderPartial('my-files-ajax', $data);
        }

        return $this->render('my-files', $data); 
    }

    public function actionRename()
    {
        $model = new FileForm();

        if ($model->load(App::post())) {
            if (App::get('ajaxValidate')) {
                return $this->asJson(ActiveForm::validate($model));
            }

            if ($model->rename()) {
                return $this->asJson([
                    'status' => 'success',
                    'message' => 'File renamed.',
                    'model' => $model
                ]);
            }
            else {
                return $this->asJson([
                    'status' => 'failed',
                    'error' => $model->errors
                ]);
            }
        }

        return $this->asJson([
            'status' => 'failed',
            'error' => 'No post data'
        ]);
    }

    public function actionUpdate($token)
    {
        $model = File::controllerFind($token, 'token');

        if (App::get('ajaxValidate')) {
            return $this->_ajaxValidate($model);
        }

        $response = [];

        if ($model->load(App::post())) {
            if ($model->save()) {
                $model->name = strtoupper($model->name);
                $response['status'] = 'success';
                $response['message'] = 'File Updated.';
                $response['file'] = $model;
            }
            else {
                $response['status'] = 'failed';
                $response['error'] = $model->errorSummary;
            }
        }
        else {
            $response['status'] = 'failed';
            $response['error'] = 'No post data';
        }
        return $this->asJson($response);
    }

    public function actionSystemFiles()
    {
        $searchModel = new FileSearch();

        $searchModel->pagination = 12;
        $dataProvider = $searchModel->search(['FileSearch' => App::queryParams()]);
        $dataProvider->query->groupBy(['name', 'size', 'extension']);

        $data = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => new FileForm()
        ];

        if (App::isAjax()) {
            return $this->renderPartial('system-files-ajax', $data);
        }

        return $this->render('system-files', $data); 
    }

    public function actionViewer($token)
    {
        $model = File::controllerFind($token, 'token');

        $this->layout = 'file-viewer';

        switch ($model->extension) {
            case 'pdf':
                return $this->render('viewer/pdf', ['model' => $model]);
                break;

            case 'gif':
                return $this->render('viewer', [
                    'model' => $model, 
                    'location' => App::baseUrl($model->location)
                ]);
                break;

            case 'csv':
            case 'xls':
            case 'xlsx':
                if (App::isAjax()) {
                    return $this->asJson(['data' => (new SpreadsheetReaderForm(['file' => $model]))->data]);
                }
                else {
                    return $this->render('viewer/spreadsheet', ['model' => $model]);
                }
                break;

            case 'jpeg':
            case 'jpg':
            case 'bmp':
            case 'tiff':
            case 'png':
            case 'ico':
            case 'webp':
            case 'giff':
            case 'jfif':
                // return $this->redirect($model->drawUrl);
                return $this->render('viewer', ['model' => $model]);
                break;

            case 'doc':
            case 'docx':
                return $this->render('viewer/docx', ['model' => $model]);
                break;

            case 'sql':
            case 'txt':
                return $this->render('viewer/sql', ['model' => $model]);

            default:
                return 'No Preview Available';
                return $this->redirect($model->getDisplayPath(500, 500));
                break;
        }
    }


    public function actionAdvancedEdit($token)
    {
        $model = File::controllerFind($token, 'token');

        if ($model->isImage) {
            $this->layout = 'file-viewer';
            return $this->render('advanced-edit', [
                'model' => $model
            ]);
        }

        return 'file cannot be edited';
    }


    public function actionDraw($token)
    {
        $model = File::controllerFind($token, 'token');

        if ($model->isImage) {
            // $this->layout = 'file-viewer';
            return $this->render('draw', [
                'model' => $model
            ]);
        }

        return $this->redirect($model->viewerurl);

        return 'file cannot be edited';
    }

    public function actionOther()
    {
        $tags = array_keys(ArrayHelper::map(App::params('other_plans'), 'label', 'description'));

        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(['FileSearch' => App::queryParams()]);
        $dataProvider->query->andWhere(['tag' => $tags]);

        return $this->render('other', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUploadFormByTag($tag='')
    {
        $model = new File();
        return $this->asJson([
            'status' => 'success',
            'form' => $this->renderAjax('_upload-form-by-tag', [
                'tag' => $tag,
                'model' => $model,
            ])
        ]);
    }

    public function actionViewByTag($tag='')
    {
        $files = File::findAll(['tag' => $tag]);
        return $this->asJson([
            'status' => 'success',
            'files' => $this->renderAjax('_table-by-tag', [
                'files' => $files,
            ])
        ]);
    }

    public function actionDeleteFolder()
    {
        if (($post = App::post()) != null) {
            if (($path = $post['path'] ?? null) != null) {
                FileHelper::removeDirectory(
                    FileHelper::normalizePath(implode(DIRECTORY_SEPARATOR, [
                        Yii::getAlias('@webroot/protected/uploads'),
                        $path
                    ]))
                );

                return $this->asJson([
                    'status' => 'success',
                    'message' => 'Folder deleted',
                ]);
            }
        }

        return $this->asJson([
            'status' => 'failed',
            'message' => 'No post data'
        ]);
    }
}