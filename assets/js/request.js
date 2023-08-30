const STATUS_PENDING = 0;
const STATUS_APPROVED = 1;
const STATUS_DECLINED = 2;
const STATUS_CANCELLED = 3;

$('#request-form').on('beforeSubmit', function() {
	KTApp.block('#modal-change-status .modal-body', {
		overlayColor: '#000000',
		message: 'Please wait',
		state: 'primary'
	})
})

$('.btn-change-status').click(function() {
	const status = $(this).data('status');
	switch(status) {
		case STATUS_PENDING:
			break;

		case STATUS_APPROVED:
			$('#modal-change-status .modal-title').html('Approve Request');
			$('#request-description').val('Approved Request');
			$('.field-request-driver').show();
			$('.field-request-responders').show();
			$('.field-request-patient-companions').show();
			$('.field-request-ambulance_dispatched').show();
			$('input[value="0"').prop('checked', true);
			break;

		case STATUS_DECLINED:
			$('#modal-change-status .modal-title').html('Decline Request');
			$('#request-description').val('Declined Request');
			$('.field-request-driver').hide();
			$('.field-request-responders').hide();
			$('.field-request-patient-companions').hide();
			$('.field-request-ambulance_dispatched').hide();
			$('input[value="1"').prop('checked', true);
			break;

		case STATUS_CANCELLED:
			$('#modal-change-status .modal-title').html('Cancel Request');
			$('#request-description').val('Cancelled Request');
			$('.field-request-driver').hide();
			$('.field-request-responders').hide();
			$('.field-request-patient-companions').hide();
			$('.field-request-ambulance_dispatched').hide();
			$('input[value="1"').prop('checked', true);
			break;

		default:
	}

	$('#request-status').val(status);

	$('#modal-change-status').modal('show');
})