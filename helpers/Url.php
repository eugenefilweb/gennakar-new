<?php

namespace app\helpers;

use Yii;
use app\helpers\App;
use app\models\File;
use app\models\Setting;
use app\models\form\setting\ImageSettingForm;
use app\widgets\Anchor;

class Url extends \yii\helpers\Url
{
    public static function image($token='', $params = [], $scheme=false, $displayPath=false)
    {
        $file = is_object($token)? $token: File::findByToken($token);

        if ($file && $file->exists) { }
        else {
            $token = 'token-default-image_200';
            if (($image_setting = Setting::findOne(['name' => ImageSettingForm::NAME])) != null) {
                $is = json_decode($image_setting->value, true);
                $token = $is['image_holder'];
            }

            $file = File::findByToken($token);

        }

        if ($file && $file->exists) {
            $url = App::component('imageResize')->getUrl(
                $file->displayRootPath, 
                (($params['w'] ?? ($file->width ?: 100)) ?: 100), 
                (($params['h'] ?? ($file->height ?: 100)) ?: 100), 
                'inset', 
                $params['quality'] ?? 90,
                null,
                $file->location
            );

            return $scheme ? Yii::$app->request->hostInfo . $url: $url;
        }

        return self::to(array_merge(['file/display', 'token' => $token], $params), $scheme);
    }

    public static function download($token='', $scheme=false)
    {
        return self::to(['file/download', 'token' => $token], $scheme);
    }

    public static function to($url = '', $scheme = false)
    {
        // if (is_array($url)) {
        //     if ($url[0] != '/') {
        //         array_unshift($url, "/");
        //     }
        // }

        if (! App::isWeb()) {
            if ($scheme) {
                return Yii::$app->urlManager->createAbsoluteUrl($url);
            }
            else {
                return Yii::$app->urlManager->createUrl($url);
            }
        }

        return parent::to($url, $scheme);
    }

    public static function userCanRoute($link)
    {
        $anchor = Anchor::widget(['link' => $link]);

        return $anchor ? true: false;
    }

    public static function isLink($str)
    {
        return filter_var($str, FILTER_VALIDATE_URL);
    }

    public static function domain()
    {
        return str_replace('//', '', self::ensureScheme(self::base(true), ''));
    }
}