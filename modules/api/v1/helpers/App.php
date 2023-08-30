<?php

namespace app\modules\api\v1\helpers;

use Yii;

class App extends \app\helpers\App
{
	public static function mailer()
	{
		return self::component('mailer');
	}
}