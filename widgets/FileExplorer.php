<?php

namespace app\widgets;

use Yii;
use app\helpers\FileHelper;
use app\helpers\Url;
use app\helpers\App;
use app\models\File;


class FileExplorer extends BaseWidget
{
    public $template = 'index';
    public $path;
    public $directories = [];
    public $files = [];
    public $reloadUrl = ['document-library/index'];
    public $addFolderUrl = ['document-library/add-folder'];
    public $folderImage = 'default/file-explorer/folder-icon.png';
    public $addFolderImage = 'default/file-explorer/create-folder-icon.png';
    public $breadcrumbs = [
        [
            'folderName' => 'Document',
            'folderPath' => ''
        ]
    ];
    public $tag = 'Document';
    public $hideFiles = ['.htaccess', 'index.php'];

    public function generateBreadcrumbs($path)
    {
        $replace = Yii::getAlias('@webroot/protected/uploads');
        $lastChar = substr($path, -1);
        if ($lastChar == DIRECTORY_SEPARATOR) {
            $replace = $replace . DIRECTORY_SEPARATOR;
        }

        $_path = str_replace(FileHelper::normalizePath($replace), '', $path);

        if ($_path) {
            $explodePath = explode(DIRECTORY_SEPARATOR, $_path);
            $breadcrumbs = $this->breadcrumbs;

            $currentPath = [];
            
            foreach ($explodePath as $xp) {
                if ($xp) {
                    $currentPath[] = $xp;
                    $breadcrumbs[] = [
                        'folderName' => $xp,
                        'folderPath' => FileHelper::normalizePath(implode(DIRECTORY_SEPARATOR, $currentPath)),
                    ];
                }
            }

            $this->breadcrumbs = $breadcrumbs;
        }
    }

    public function init()
    {
        parent::init();

        $this->path = $this->path ?: (App::get('path') ?: '');

        if (! Url::isLink($this->folderImage)) {
            $this->folderImage = App::baseUrl($this->folderImage);
        }

        if (! Url::isLink($this->addFolderImage)) {
            $this->addFolderImage = App::baseUrl($this->addFolderImage);
        }

        $this->reloadUrl = Url::to($this->reloadUrl);
        $this->addFolderUrl = Url::to($this->addFolderUrl);

        $path = FileHelper::normalizePath($this->path);
        $path = FileHelper::normalizePath(implode(DIRECTORY_SEPARATOR, [
            Yii::getAlias('@webroot/protected/uploads'),
            $path
        ]));

       $this->generateBreadcrumbs($path);


        $directories = FileHelper::findDirectories($path, ['recursive' => false]);

        $files = FileHelper::findFiles($path, [
            'recursive' => false,
            'filter' => function($path) {
                $exp = explode(DIRECTORY_SEPARATOR, $path);

                $file = File::find()
                    ->select(['*', 'SUBSTRING_INDEX(location, "/", -1) AS folderFileName'])
                    ->where(['SUBSTRING_INDEX(location, "/", -1)' => end($exp)])
                    ->one();

                if (!$file) {
                    return false;
                }

                $this->files[] = $file;

                return ! $this->isFileInHideFiles($file->location);
            }
        ]);

        $this->formatDirectories($directories);
    }

    protected function isFileInHideFiles($location = '')
    {
        $array = explode('/', $location);

        if ($array) {
            return in_array(end($array), $this->hideFiles);
        }

        return false;
    }

    public function formatDirectories($directories)
    {
        $_directories = [];
        foreach ($directories as $directories) {
            $exp = explode(DIRECTORY_SEPARATOR, FileHelper::normalizePath($directories));
            $path = str_replace(
                FileHelper::normalizePath(Yii::getAlias('@webroot/protected/uploads')) . DIRECTORY_SEPARATOR, 
                '', 
                FileHelper::normalizePath($directories)
            );


            $files = FileHelper::findFiles($directories, [
                'recursive' => false,
                'filter' => function($path) {
                    $exp = explode(DIRECTORY_SEPARATOR, $path);

                    $file = File::find()
                        ->select(['*', 'SUBSTRING_INDEX(location, "/", -1) AS folderFileName'])
                        ->where(['SUBSTRING_INDEX(location, "/", -1)' => end($exp)])
                        ->one();


                    if (!$file) {
                        return false;
                    }
                    
                    return ! $this->isFileInHideFiles($file->location);
                }
            ]);

            $folders = FileHelper::findDirectories($directories, ['recursive' => false]);


            $_directories[end($exp)] = [
                'fullpath' => FileHelper::normalizePath($directories),
                'path' => $path,
                'files' => $files,
                'folders' => $folders,
                'total_documents' => count($files) + count($folders)
            ];
        }
        $this->directories = $_directories;
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render("file-explorer/{$this->template}", [
            'directories' => $this->directories,
            'files' => $this->files,
            'reloadUrl' => $this->reloadUrl,
            'addFolderUrl' => $this->addFolderUrl,
            'breadcrumbs' => $this->breadcrumbs,
            'path' => $this->path,
            'folderImage' => $this->folderImage,
            'addFolderImage' => $this->addFolderImage,
            'tag' => $this->tag,
        ]);
    }
}
