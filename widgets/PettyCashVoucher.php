<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Html;
use app\helpers\Url;

class PettyCashVoucher extends BaseWidget
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

        $profile = App::identity('profile');
        $payee = $profile ? ($profile->fullname ?: '[PAYEE]'): '[PAYEE]';
        
        $replace = [
            '[AMOUNT]' => $this->transaction->amount,
            '[FULLNAME]'  => strtoupper($member->fullname),
        ];

        $this->content = str_replace(array_keys($replace), array_values($replace), $template->petty_cash_voucher);
    }


    public function run()
    {
        if ($this->contentOnly) {
            return  $this->content;
        }
        
        return $this->render('petty-cash-voucher/index', [
            'content' => $this->content,
            'model' => $this->model,
        ]);
    }
}
