<?php

use app\modules\api\v1\helpers\Url;
use app\modules\api\v1\helpers\Html;

$url = Url::to(['site/reset-password', 'password_reset_token' => $user->password_reset_token], true);
?>

<p>You may change your password by clicking the link below. | <?= $user->password_reset_token ?></p>

<p><?= Html::a($url, $url) ?></p>