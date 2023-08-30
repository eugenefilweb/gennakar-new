<?php

use app\helpers\App;
?>
<p>You are signing in to <?= App::appName() ?></p>
<p>Here's your <b>two factor</b> authentication code.</p>
<h3><?= $token->code ?></h3>
<p>This code will expire after an hour.</p>