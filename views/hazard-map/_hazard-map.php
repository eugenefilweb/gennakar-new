<?php

use app\helpers\Html;

$this->registerCss(<<< CSS
	.hazard-map .ribbon:hover {
		cursor: pointer;
		box-shadow: 0px 2px 5px 2px rgb(82 63 105 / 5%);
	}
	.hazard-map .ribbon {
		border: 1px dashed #ccc;
	    border-radius: 4px;
	    padding: 10px;
	}

	.hazard-map .ribbon-target {
		top: -1px;
	    left: -1px;
	    border-top-left-radius: 4px !important;
	    border-top-right-radius: 0 !important;
	}

	div.scrollToBottomContainer { 
	    width: 90%; 
	    display: table; 
	    position: absolute;
	   /* right: 1em;
	    bottom: 1em;*/
	    top: 40%;
	    z-index: 2;
	}
	div.scrollToBottomContainer span {
	    display: table-cell;
	    width: 1%;
	}
	div.scrollToBottomContainer span:nth-of-type(2) {
	    width: 99%;
	    text-align: center;
	}

	.hazard-map .btn-group {
		display: none;
	}

	.shade-image {
	    -webkit-filter: brightness(85%);
	    -webkit-transition: all 10ms ease;
	    -moz-transition: all 10ms ease;
	    -o-transition: all 10ms ease;
	    -ms-transition: all 10ms ease;
	    transition: all 10ms ease;
	}
CSS);

$this->registerJs(<<< JS
	$('.hazard-map .ribbon').on('mouseover', function(e) {
		$(this).find('.btn-group').show();
		$(this).find('img').addClass('shade-image');
	}).on('mouseleave', function(e) {
		$(this).find('.btn-group').hide();
		$(this).find('img').removeClass('shade-image');
	})
JS);
?>

<div class="hazard-map mb-5">
	<div class="ribbon ribbon-left" data-url="<?= $model->viewUrl ?>">
	    <div class="ribbon-target bg-info font-weight-bold">
	    	<?= $model->name ?>
	    </div>
	    <div class="scrollToBottomContainer">
            <span></span>
            <span>
            	<div class="btn-group">
            		<?= Html::a('<i class="fas fa-map-marker-alt text-success"></i>', ['file/draw', 'token' => $model->photo], [
            			'class' => 'btn btn-icon btn-white btn-sm',
            			'title' => 'Map Editor',
            			'target' => '_blank',
            			'data-toggle' => 'tooltip'
            		]) ?>
            		<?= Html::a('<i class="fas fa-eye text-info"></i>', $model->viewUrl, [
            			'class' => 'btn btn-icon btn-white btn-sm',
            			'title' => 'View',
            			'data-toggle' => 'tooltip'
            		]) ?>

            		<?= Html::a('<i class="fas fa-edit text-primary"></i>', $model->updateUrl, [
            			'class' => 'btn btn-icon btn-white btn-sm',
            			'title' => 'Edit',
            			'data-toggle' => 'tooltip'
            		]) ?>

            		<?= Html::a('<i class="fas fa-copy text-warning"></i>', $model->duplicateUrl, [
            			'class' => 'btn btn-icon btn-white btn-sm',
            			'title' => 'Duplicate',
            			'data-toggle' => 'tooltip'
            		]) ?>
			    	
			    	<?= Html::a('<i class="fas fa-trash text-danger"></i>', $model->deleteUrl, [
            			'class' => 'btn btn-icon btn-white btn-sm',
            			'title' => 'Delete',
            			'data-toggle' => 'tooltip',
            			'data-confirm' => 'Are you sure?',
            			'data-method' => 'post'
            		]) ?>
            	</div>
            </span>
            <span></span>
        </div>

		<?= Html::image($model->photo, ['w' => 350], [
			'class' => 'img-fluid symbol',
			'loading' => 'lazy'
		]) ?>
	</div>
</div>
