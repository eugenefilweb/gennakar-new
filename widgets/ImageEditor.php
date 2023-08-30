<?php

namespace app\widgets;

use Yii;
use app\helpers\App;

class ImageEditor extends BaseWidget
{
    public $file;
    public $path;

    public function init()
    {
    	parent::init();

    	$this->path = App::publishedUrl('/markerjs2/', Yii::getAlias('@app/assets'));
    }

    public function run()
    {
        return $this->render("image-editor", [
            'file' => $this->file,
            'path' => $this->path,
        ]);
    }
}
