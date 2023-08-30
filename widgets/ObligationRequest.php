<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;

class ObligationRequest extends BaseWidget
{
    public $transaction;
    public $content;

    public $contentOnly = false;

    public function init()
    {
        parent::init();
        $template = App::setting('reportTemplate');
        $template->setData();

        $member = $this->transaction->member;

        $replace = [
            '[AMOUNT]' => number_format($this->transaction->amount, 2),
            '[FULLNAME]'  => ucwords(strtolower($member->fullname)),
            '[ADDRESS]' => $member->address,
            '[ACCOUNT_CODE]' => $member->isSeniorAge ? '5-02-99-990':'5-02-99-080'
        ];

        $this->content = str_replace(array_keys($replace), array_values($replace), $template->obligation_request);
    }


    public function run()
    {
        if ($this->contentOnly) {
            return  $this->content;
        }
        
        return $this->render('obligation-request/index', [
            'content' => $this->content,
            'model' => $this->model,
        ]);
    }
}
