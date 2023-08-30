<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Html;
use app\helpers\qrcode\{QRImageWithLogo, LogoOptions};
use app\models\File;
use chillerlan\QRCode\QRCode As QRCLass;

class QRCode extends BaseWidget
{
    public $model;
    public $qr;
    public $img = false;
    public $photo;
    public $path;

    public function init()
    {
        parent::init();

        $options = new LogoOptions;

        $options->version          = 7;
        $options->eccLevel         = QRCLass::ECC_H;
        $options->imageBase64      = true;
        $options->logoSpaceWidth   = 15;
        $options->logoSpaceHeight  = 15;
        $options->scale            = 5;
        $options->imageTransparent = false;

        if (!$this->path) {
            $this->qr = new QRImageWithLogo($options, (new QRCLass($options))->getMatrix($this->model->qr_id));

            $this->setPhoto();
        }
    }

    public function setPhoto()
    {
        $this->photo = App::setting()->getQrCodePath();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->path) {
            return Html::img((new QRCLass)->render($this->path), [
                'class' => 'img-thumbnail symbol',
            ]);
        }

        if($this->img == false) {
            try {
                return $this->qr->dump(null, $this->photo);
            } catch (\yii\base\ErrorException $e) {
                return;
            }
        }

        return $this->render('qrcode', [
            'model' => $this->model,
            'qr' => $this->qr,
        ]);
    }
}
