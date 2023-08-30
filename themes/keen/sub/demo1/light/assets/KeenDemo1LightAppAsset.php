<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\keen\sub\demo1\light\assets;
use yii\web\AssetBundle;
/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class KeenDemo1LightAppAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/keen/sub/demo1/main/assets/assets';
    public $css = [
        'fonts/Google-Poppins.css',
        'css/pages/wizard/wizard-2.css',
        'plugins/custom/cropper/cropper.bundle.css',
        'plugins/custom/prismjs/prismjs.bundle.css',
        'css/style.bundle.css',
        'css/themes/layout/header/base/light.css',
        'css/themes/layout/header/menu/light.css',
        'css/themes/layout/brand/dark.css',
        'css/themes/layout/aside/dark.css',
        'css/themes/layout/brand/light.css',
        'css/themes/layout/aside/light.css',
    ];
    public $js = [
        'plugins/custom/cropper/cropper.bundle.js',
        'plugins/custom/prismjs/prismjs.bundle.js',
        'js/scripts.bundle.js',
        'plugins/custom/tinymce/tinymce.bundle.js',
        'js/pages/features/forms/widgets/bootstrap-datetimepicker.js',
        'plugins/custom/datatables/datatables.bundle.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}