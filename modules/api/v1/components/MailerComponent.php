<?php

namespace app\modules\api\v1\components;

class MailerComponent extends \app\components\MailerComponent
{
    public $useFileTransport = true;
    public $viewPath = '@app/modules/api/v1/mail';
    public $fileTransportPath = '@app/modules/api/v1/runtime/mail';
    public $htmlLayout = '@app/modules/api/v1/mail/layouts/html';
    public $textLayout = '@app/modules/api/v1/mail/layouts/text';
}