<?php

namespace app\components;

use Yii;
use app\helpers\App;
use app\helpers\Url;
use app\models\form\setting\ImageSettingForm;
use yii\helpers\Json;

class ViewComponent extends \yii\web\View
{
    public function init()
    {
        parent::init();

        $this->registerJsVar('app', [
            'appName' => App::appName(),
            'baseUrl' => Url::base() . '/',
            'baseFullUrl' => Url::base(true) . '/',
            'language' => App::appLanguage(),
            'api' => Url::base(true) . '/api/v1/',
            'csrfToken' => App::request('csrfToken'),
            'csrfParam' => App::request('csrfParam'),
            'params' => App::params(),
            'defaultImageUrl' => Url::image((new ImageSettingForm())->image_holder, ['w' => 200]),
            'mapMarkerUrl' => Url::image((new ImageSettingForm())->household_map_icon, ['w' => 50]),
            'mapStartMarkerUrl' => Url::image((new ImageSettingForm())->map_icon_start, ['w' => 50]),
            'mapEndMarkerUrl' => Url::image((new ImageSettingForm())->map_icon_end, ['w' => 50]),
        ]);

        $loadingIcon = App::baseUrl('default/loader-blocks.gif');

        $this->registerCss(<<< CSS
            .SfxButton-Label {
                font-family: inherit !important;
            }
            .mw-500 {width: -webkit-fill-available !important; max-width: 500px !important;}
            /*.mw-400 {width: -webkit-fill-available !important; max-width: 400px !important;}*/
            .mw-200 {width: -webkit-fill-available !important; max-width: 200px !important;}
            .mw-150 {width: -webkit-fill-available !important; max-width: 150px !important;}
            .mw-100 {width: -webkit-fill-available !important; max-width: 100px !important;}
            .mw-120 {width: -webkit-fill-available !important; max-width: 120px !important;}
            .aside-menu .menu-nav > .menu-section .menu-text {
                color: #ffffff;
            }
            .app-iconbox {
                box-shadow: rgb(0 0 0 / 30%) 0px 1px 4px 0 !important;
            }
            .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item > .menu-link .menu-text, .aside-menu .menu-nav > .menu-item > .menu-heading .menu-icon, .aside-menu .menu-nav > .menu-item > .menu-link .menu-icon,
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-heading .menu-icon, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-link .menu-icon,
            .aside-menu .menu-nav > .menu-item > .menu-heading .menu-arrow, .aside-menu .menu-nav > .menu-item > .menu-link .menu-arrow,
            .menu-item-open .menu-link i,
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item > .menu-link .menu-text,
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-icon, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-icon {
                color: #fff;
            }
            .menu-link i {color: #fff;}
            .aside, .brand, .aside-menu, 
            .aside-menu .menu-nav > .menu-item.menu-item-here > .menu-heading, 
            .aside-menu .menu-nav > .menu-item.menu-item-here > .menu-link, 
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-heading {
                background-color: #101010;
            }
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-link {
                background-color: #fff;
            }
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link,
            .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link,
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link,
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link {
                background-color: #fff;
            }
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-text,
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link i,
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-arrow, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-arrow,
            .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-text,
            .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading .menu-arrow, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-arrow,
            .menu-item-open:hover > .menu-link i,
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-text,
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-text {
                color: #101010;
            }
            .aside-menu .menu-nav > .menu-item > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item > .menu-link .menu-icon.svg-icon svg g [fill] {
                fill: #fff;
            }
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-icon.svg-icon svg g [fill],
            .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-icon.svg-icon svg g [fill] {
                fill: #101010;
            }
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-icon.svg-icon svg g [fill] {
                fill: #101010;
            }
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-link .menu-text {
                color: #101010
            }
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-heading .menu-icon, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-link .menu-icon {
                color: #fff;
            }
            .brand .btn .svg-icon svg g [fill] {
                fill: #fff;
            }
            .datepicker.datepicker-orient-top,
            .content .bootstrap-select .dropdown-menu {
                z-index: 999 !important;
            }
            .detail-view th {
                vertical-align: top;
                width: 20%;
                white-space: nowrap;
            }
            .report-title {
                font-size: 2rem !important;
                font-weight: 500;
                text-transform:uppercase;
            }
            .report-subtitle {
                font-size: 1.5rem !important;
                font-weight: 500;
                text-transform:uppercase;
            }
            /*.page-loading {
                background: white url('{$loadingIcon}') no-repeat center center / 10rem;
            }*/
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link {
                background-color: #a0a0a073;
            }
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-text, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link i, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-arrow, .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-arrow, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading .menu-arrow, .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-arrow, .menu-item-open:hover > .menu-link i, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-text {
                color: #fff;
            }
            .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover > .menu-link .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item.menu-item-open > .menu-link .menu-icon.svg-icon svg g [fill] {
                fill: #ffffff;
            }
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-link {
                background-color: #a0a0a073;
            }
            .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item .menu-submenu .menu-item.menu-item-active > .menu-link .menu-text {
                color: #ffffff;
            }
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-icon.svg-icon svg g [fill], .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-icon.svg-icon svg g [fill] {
                fill: #ffffff;
            }
        CSS);
    }

    public function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

	public function registerWidgetJs($widgetFunction, $js, $position = parent::POS_READY, $key = null)
    {
        $widgetFunction = $widgetFunction . $this->generateRandomString();
        $js = <<< JS
            let {$widgetFunction} = function() {
                let load = function() {
                    {$js}
                }
                return {
                    init: function() {
                        load();
                    }
                }
            }(); {$widgetFunction}.init();
        JS;

        parent::registerjs($js, $position, $key);
    }

    public function registerWidgetCssFile ($files, $depends=[])
    {
        $depends = $depends ?: [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
        $files = is_array($files) ? $files: [$files];
        foreach ($files as $css) {
            $this->registerCssFile(App::publishedUrl("/widget/css/{$css}.css", Yii::getAlias('@app/assets')), [
                'depends' => $depends
            ]);
        }
    }

    public function registerWidgetJsFile ($files, $depends=[])
    {
        $depends = $depends ?: [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
        $files = is_array($files) ? $files: [$files];
        foreach ($files as $js) {
            $this->registerJsFile(App::publishedUrl("/widget/js/{$js}.js", Yii::getAlias('@app/assets')), [
                'depends' => $depends
            ]);
        }
    }

    public function addJsFile ($files, $depends=[], $options=[])
    {
        $depends = $depends ?: [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
        $options['depends'] = $depends;
        $files = is_array($files) ? $files: [$files];
        foreach ($files as $js) {
            $this->registerJsFile(App::publishedUrl("/{$js}.js", Yii::getAlias('@app/assets')), $options);
        }
    }

    public function addCssFile ($files, $depends=[])
    {
        $depends = $depends ?: [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
        $files = is_array($files) ? $files: [$files];
        foreach ($files as $css) {
            $this->registerCssFile(App::publishedUrl("/{$css}.css", Yii::getAlias('@app/assets')), [
                'depends' => $depends
            ]);
        }
    }
}