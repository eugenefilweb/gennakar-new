<?php

use app\helpers\Html;
use app\helpers\Url;
use app\models\Database;
use app\widgets\ActiveForm;
use app\widgets\Autocomplete;

$this->registerWidgetJs($widgetFunction, <<< JS
	let viewMemberByName = function() {
		KTApp.block('body', {
			overlayColor: '#000000',
			state: 'warning',
			message: 'Please wait...'
		});
		$.ajax({
			url: app.baseUrl + 'database/find-name-qr-keywords',
			data: {
				keywords: $('input[name="search-name-{$widgetId}"]').val(),
				suggestionOnly: 'false'
			},
			dataType: 'json',
			success: function(s) {

				if (s.status == 'success') {
					$('#modal-search-qr-id-{$widgetId} .modal-body').html(s.html);
					$('#modal-search-qr-id-{$widgetId}').modal('show');
				}
				else {
					Swal.fire('Error', s.error, 'error');
				}
				KTApp.unblock('body');
			},
			error: function(e) {
				Swal.fire('Error', e.responseText, 'error');
				KTApp.unblock('body');
			}
		});
	}

	$('#btn-search-name-{$widgetId}').click(function() {
		viewMemberByName();
	});

	$('[data-dismiss="modal"]').on('click', function() {
		location.reload();
	});
	$(document).keyup(function(e) {
	    if (e.key === "Escape") { // escape key maps to keycode `27`
			location.reload();
	    }
	});
JS);

$this->registerCss(<<< CSS
	.modal-dialog.modal-xl {
	    max-width: 1400px;
	}
	.search-qr-code-container .card {
		outline: 2px solid #337ab7;
	}
	.search-qr-code-container .card-header {
		background: #337ab7;
		background-color: #337ab7 !important;
	}
	.search-qr-code-container .card-label, .search-qr-code-container i {
		color: #fff !important;
	}
CSS);

$memberCreateUrl = (new Database())->createUrl;
?>

<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
	'title' => $title,
	'stretch' => true,
	'class' => 'search-qr-code-container'
]); ?>
	<div class="search-qr-code">
		<?= Autocomplete::widget([
			'url' => Url::to(['database/find-name-qr-keywords']),
            'submitOnclickJs' => <<< JS
				KTApp.block('body', {
					overlayColor: '#000000',
					state: 'warning',
					message: 'Please wait...'
				});
				$.ajax({
					url: app.baseUrl + 'database/find-name-qr-keywords',
					data: {
						keywords: inp.value,
						suggestionOnly: 'false'
					},
					dataType: 'json',
					success: function(s) {
						if (s.status == 'success') {
							$('#modal-search-qr-id-{$widgetId} .modal-body').html(s.html);
							$('#modal-search-qr-id-{$widgetId}').modal('show');
						}
						else {
							Swal.fire('Error', s.error, 'error');
						}
						KTApp.unblock('body');
					},
					error: function(e) {
						Swal.fire('Error', e.responseText, 'error');
						KTApp.unblock('body');
					}
				});
			JS,
			'input' => <<< HTML
				<div class="input-group">
					<input type="text" class="form-control form-control-lg" name="search-name-{$widgetId}" placeholder="Type Name" autofocus="on">
					<div class="input-group-append">
						<button class="btn btn-primary btn-lg" type="button" id="btn-search-name-{$widgetId}">
							Search
						</button>
					</div>
				</div>
				<label class="mt-5">
					Member not found? Create <a href="{$memberCreateUrl}" target="_blank">here</a>
				</label>
			HTML,
        ]) ?>
	</div>
<?php $this->endContent(); ?>

<div class="modal fade" id="modal-search-qr-id-<?= $widgetId ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                	General Information
                </h5> 
                <button type="button" class="close btn-close-search-qr-id" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold btn-close-search-qr-id" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>