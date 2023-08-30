<?php

namespace app\models\form;

use Yii;
use app\helpers\App;
use app\models\form\CustomEmailForm;

class BulkEmailForm extends \yii\base\Model
{
    public $to;
    public $subject = 'Subject';
    public $content;

    public function rules()
    {
        return [
            [['to', 'subject', 'content'], 'required'],
            [['to',], 'safe'],
            [['content'], 'string'],
        ];
    }

    public function send()
    {
        if ($this->validate()) {
            $messages = App::foreach($this->to, function($email) {
                $model = new CustomEmailForm([
                    'to' => $email,
                    'subject' => $this->subject,
                    'content' => $this->content,
                ]);
                return $model->send('multiple');
            }, false);

            return Yii::$app->mailer->sendMultiple($messages);
        }
        return false;
    }
}