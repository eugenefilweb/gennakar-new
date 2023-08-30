<?php

use app\helpers\Html;
use app\helpers\Url;

$this->registerCss(<<< CSS
	.dropdown-item-hover {
        color: #101221;
        background-color: #F3F6F9;
    }
CSS);

$this->registerJs(<<< JS
    $(document).on('change', '.taglist', function() {
        let tag = $(this).val();

        var href = new URL(location.href);
        href.searchParams.set('tag', tag);

        var link = document.createElement('a');
        link.href = href.toString();
        $('.taglist-container').append(link);
        link.click();    
    });
JS)
?>

<div class="text-right mt-2 taglist-container">
    <?= Html::dropDownList("taglist", $activeTag, $tags, [
        'prompt' => '~ All Tags ~',
        'class' => 'form-control taglist',
    ])  ?>
</div>
