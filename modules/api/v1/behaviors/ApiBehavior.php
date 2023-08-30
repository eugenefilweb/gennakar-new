<?php

namespace app\modules\api\v1\behaviors;
use yii\web\Response;

class ApiBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Response::EVENT_BEFORE_SEND => 'beforeSend',
        ];
    } 

    public function beforeSend($event)
    {
        $sender = $event->sender;

        if ($sender->data !== null) {
            $event->sender->data = [
                'status' => $sender->isSuccessful,
                'data' => $sender->data,
            ];
            // $event->sender->statusCode = 200;
        }
    }
}