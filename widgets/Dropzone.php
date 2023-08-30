<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Url;
use app\models\File;
use yii\helpers\ArrayHelper;
 
class Dropzone extends BaseWidget
{
    public $parameters = [];
    public $paramName = 'UploadForm[fileInput]';
    public $maxFiles = 10;
    public $maxFilesize = 100; // MB
    public $addRemoveLinks = true;
    public $url = ['file/upload'];
    public $title = 'Drop files here or click to upload.';
    public $description;
    public $dictRemoveFileConfirmation = 'Remove File ?';
    public $dictRemoveFile = 'Remove';
    public $tag;

    public $model;
    public $removeFileUrl = ['file/delete'];
    public $complete;
    public $success;
    public $removedFile;
    public $acceptedFiles;
    public $init;
    public $sending;

    public $files = [];
    public $inputName;
    public $attribute;
    public $extensions;
    public $path;

    public $documentLibrary = false;


    public function init() 
    {
        // your logic here
        parent::init();

        if ($this->documentLibrary) {
            $_path = implode(DIRECTORY_SEPARATOR, [
                'protected',
                'uploads'
            ]);

            if ($this->path) {
                $this->path = implode(DIRECTORY_SEPARATOR, [
                    $_path,
                    $this->path
                ]);
            }
            else {
                $this->path = $_path;
            }

            $this->path = implode(',', (explode(DIRECTORY_SEPARATOR, $this->path)));
        }

        $className = App::className($this->model);
        if (!$this->description) {
            $this->description = "Upload up to {$this->maxFiles} file(s)";
        }
        if ($this->tag) {
            $this->parameters['UploadForm[tag]'] = $this->tag;
        }
        $this->parameters[App::request('csrfParam')] = App::request('csrfToken');
        $this->parameters['UploadForm[modelName]'] = $className;
        $this->url = Url::to($this->url);
        $this->removeFileUrl = Url::to($this->removeFileUrl);
        if (!$this->removedFile) {
            // $this->removedFile = "$.ajax({
            //     url: '{$this->removeFileUrl}/?token=' + file.upload.uuid,
            //     method: 'post',
            //     dataType: 'json',
            //     cache: false,
            //     success: function(s) {
            //         let inp = $('input[data-uuid=\"'+ file.upload.uuid +'\"]');

            //         if(inp.length) {
            //             inp.remove();
            //         }
            //     },
            //     error: function(e) {
            //     }
            // })";

            $this->removedFile = "
                let inp = $('input[data-uuid=\"'+ file.upload.uuid +'\"]');

                if(inp.length) {
                    inp.remove();
                }
            ";
        }

        if (!$this->acceptedFiles) {
            $acceptedFiles = array_merge(
                File::EXTENSIONS['image'],
                File::EXTENSIONS['file']
            );
            $this->acceptedFiles = array_map(function($val) { return ".{$val}"; }, $acceptedFiles);
        }

        if (is_array($this->acceptedFiles)) {
            $this->acceptedFiles = implode(',', $this->acceptedFiles);
        }

        $this->extensions = explode(',', str_replace('.', '', $this->acceptedFiles));
        foreach ($this->extensions as $key => $extension) {
            $this->parameters["UploadForm[extensions][{$key}]"] = $extension;
        }

        $this->inputName = $this->inputName ?: implode('', [
            $className, 
            '[', $this->attribute, ']',
            ((is_array($this->model->{$this->attribute}))? '[]': '')
        ]);

        $this->success = $this->success .= "
            $(\"#dropzone-{$this->id}\").append(\"<input name='{$this->inputName}' data-uuid='\"+ file.upload.uuid +\"' type='hidden' value='\"+ s.file.token +\"'> \");
        ";

        if ($this->files) {
            $this->files = ArrayHelper::toArray($this->files, [
                'app\models\File' => [
                    'id',
                    'size',
                    'token',
                    'extension',
                    'name',
                    'location',
                    'upload' => function($model) {
                        return [
                            'uuid' => $model->token
                        ];
                    },
                    'fullname' => function($model) {
                        return implode('.', [$model->name, $model->extension]);
                    },
                    'imagePath' => function($model) {
                        return Url::image($model->token, [
                            'w' => 120, 
                            'quality' => 90,
                        ]);
                    }
                ]
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('dropzone', [
            'files' => $this->files,
            'encodedFiles' => json_encode($this->files),
            'id' => $this->id,
            'parameters' => json_encode($this->parameters),
            'paramName' => $this->paramName,
            'maxFiles' => $this->maxFiles,
            'maxFilesize' => $this->maxFilesize,
            'addRemoveLinks' => $this->addRemoveLinks,
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description,
            'dictRemoveFileConfirmation' => $this->dictRemoveFileConfirmation,
            'removeFileUrl' => $this->removeFileUrl,
            'dictRemoveFile' => $this->dictRemoveFile,
            'complete' => $this->complete,
            'removedFile' => $this->removedFile,
            'acceptedFiles' => $this->acceptedFiles,
            'success' => $this->success, 
            'inputName' => $this->inputName,
            'attribute' => $this->attribute,
            'model' => $this->model,
            'path' => $this->path,
            'init' => $this->init,
            'sending' => $this->sending,
            'extensions' => json_encode($this->extensions)
        ]);
    }
}
