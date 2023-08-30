<?php

namespace tests\unit\models\form\event;

use app\models\Event;
use app\models\form\event\EventDocumentForm;

class EventDocumentFormTest extends \Codeception\Test\Unit
{
    public function testValidRemove()
    {
        $model = new EventDocumentForm(['event_id' => 1]);
        $model->file_token = 'default-6ccb4a66-0ca3-46c7-88dd-default';
        $model->scenario = 'remove';
        $model->unlink = false;
        expect_that($model->save());

        $event = $this->tester->grabRecord('app\models\Event', [
            'id' => 1,
        ]);

        expect_that($event);
        expect_not($event->files);
    }

    public function testValidAdd()
    {
        $model = new EventDocumentForm(['event_id' => 1]);
        $model->file_token = 'add-6ccb4a66-0ca3-46c7-88dd-add';

        expect_that($model->save());

        $event = $this->tester->grabRecord('app\models\Event', [
            'id' => 1,
        ]);

        expect_that($event);
        expect_that($event->files);
    }

    public function testEventIdInvalid()
    {
        $model = new EventDocumentForm(['event_id' => 'invalid']);
        expect_not($model->save());
        expect($model->errors)->hasKey('event_id');
    }

    public function testEventIdNotExisting()
    {
        $model = new EventDocumentForm(['event_id' => 99999999]);
        expect_not($model->save());
        expect($model->errors)->hasKey('event_id');
    }

    public function testFileTokenInvalidOnRemoved()
    {
        $model = new EventDocumentForm(['event_id' => 1]);
        $model->scenario = 'remove';
        $model->file_token = 'invalid';
        expect_not($model->save());
        expect($model->errors)->hasKey('file_token');
    }
}