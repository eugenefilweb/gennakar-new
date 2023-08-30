<?php

namespace tests\unit\models\form\transaction;

use app\models\Transaction;
use app\models\form\transaction\SocialCaseStudyReportForm;


class SocialCaseStudyReportFormTest extends \Codeception\Test\Unit
{
    public function testValid()
    {
        $model = new SocialCaseStudyReportForm(['member_id' => 1]);

        expect_that($model->save());

        $this->tester->seeRecord('app\models\Transaction', [
            'member_id' => 1,
            'status' => Transaction::COMPLETED
        ]);
    }

    public function testMemberIdInvalid()
    {
        $model = new SocialCaseStudyReportForm(['member_id' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }

    public function testMemberIdNotExisting()
    {
        $model = new SocialCaseStudyReportForm(['member_id' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('member_id');
    }
}