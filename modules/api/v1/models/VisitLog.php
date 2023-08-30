<?php

namespace app\modules\api\v1\models;

use app\modules\api\v1\helpers\App;

class VisitLog extends \app\models\VisitLog
{
	public static function login($user)
	{
		return self::log($user, self::ACTION_LOGIN);
	}

	public static function logout($user)
	{
		return self::log($user, self::ACTION_LOGOUT);
	}

	public static function log($user, $action=self::ACTION_LOGIN)
    {
        $visit = new self();
        $visit->user_id = $user->id;
        $visit->ip = App::ip();
        $visit->action = $action;
        return $visit->save();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['BlameableBehavior']['value'] = function($event) {
            return $event->sender->user_id;
        };

        unset($behaviors['VisitLogBehavior']);

        return $behaviors;
    }
}