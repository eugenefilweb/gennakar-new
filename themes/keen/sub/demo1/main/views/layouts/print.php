<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;
use app\themes\keen\assets\KeenAsset;
use app\assets\AppAsset;
use app\themes\keen\sub\demo1\main\assets\KeenDemo1AppAsset;
use app\widgets\ReportTemplate;

AppAsset::register($this);
KeenDemo1AppAsset::register($this);
KeenAsset::register($this);

$sleep = $this->params['sleep'] ?? 1300;
$size = $this->params['size'] ?? 'A4';

$this->registerJs(<<< JS
    const sleep = ms => new Promise(resolve => setTimeout(resolve, ms));
    (async () => {
        await sleep({$sleep});
        window.print()
    })();
JS);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?= Url::image(App::setting('image')->favicon, ['w' => 16]) ?>" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        table { page-break-inside:auto; }
        tr    { page-break-inside:avoid;}
        thead { display:table-header-group; }
        tfoot { display:table-footer-group;}
        @media print {

            @page { 
                size: <?= $size ?>;
                margin: 0.3in 0.5in;
                -webkit-print-color-adjust: exact;
            }
            body {
                -webkit-print-color-adjust: exact;
                width: 100%;
            }
            .page-break {
                page-break-before: always;
            }
        }


    </style>
    <script type="text/javascript">
        var base_url = "<?= Url::home(true) ?>";
    </script>
</head>
<body style="background-color: #fff;width: 100%;">
<?php $this->beginBody() ?>
    <!-- begin:: Page --> 
    <?= Html::if($this->params['withHeader'] ?? true, ReportTemplate::widget()) ?>

    <?= $content ?>

    <script>
        var KTAppSettings = { 
            "breakpoints": { 
                "sm": 576, 
                "md": 768, 
                "lg": 992, 
                "xl": 1200, 
                "xxl": 1400 
            }, 
            "colors": { 
                "theme": { 
                    "base": { 
                        "white": "#ffffff", 
                        "primary": "#3E97FF", 
                        "secondary": "#E5EAEE", 
                        "success": "#08D1AD", 
                        "info": "#844AFF", 
                        "warning": "#F5CE01", 
                        "danger": "#FF3D60", 
                        "light": "#E4E6EF", 
                        "dark": "#181C32" 
                    }, 
                    "light": {
                        "white": "#ffffff", 
                        "primary": "#DEEDFF", 
                        "secondary": "#EBEDF3", 
                        "success": "#D6FBF4", 
                        "info": "#6125E1", 
                        "warning": "#FFF4DE", 
                        "danger": "#FFE2E5", 
                        "light": "#F3F6F9", 
                        "dark": "#D6D6E0" 
                    }, 
                    "inverse": { 
                        "white": "#ffffff", 
                        "primary": "#ffffff", 
                        "secondary": "#3F4254", 
                        "success": "#ffffff", 
                        "info": "#ffffff", 
                        "warning": "#ffffff", 
                        "danger": "#ffffff", 
                        "light": "#464E5F", 
                        "dark": "#ffffff" 
                    } 
                }, 
                "gray": { 
                    "gray-100": "#F3F6F9", 
                    "gray-200": "#EBEDF3", 
                    "gray-300": "#E4E6EF", 
                    "gray-400": "#D1D3E0", 
                    "gray-500": "#B5B5C3", 
                    "gray-600": "#7E8299", 
                    "gray-700": "#5E6278", 
                    "gray-800": "#3F4254", 
                    "gray-900": "#181C32" 
                } 
            }, 
            "font-family": "Poppins" 
        };
    </script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>