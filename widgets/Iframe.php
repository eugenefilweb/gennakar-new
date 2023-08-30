<?php

namespace app\widgets;

use Yii;
 
class Iframe extends BaseWidget
{
    public $width = '100%';
    public $height = '100vh';
    public $path;
 
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('iframe', [
            'width' => $this->width,
            'height' => $this->height,
            'path' => $this->path,
        ]);
    }
}
