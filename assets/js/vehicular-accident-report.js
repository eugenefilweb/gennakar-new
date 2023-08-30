const showVehicleForm = () => {
    $('.vehicles-container').hide();
    $('#vehicle-form').show();
}

const showPassengerForm = () => {
    $('.passengers-container').hide();
    $('#passenger-form').show();
}

const hideVehicleForm = () => {
    $('.vehicles-container').show();
    $('#vehicle-form').hide();
}

const hidePassengerForm = () => {
    $('.passengers-container').show();
    $('#passenger-form').hide();
}

const showStatementForm = () => {
    $('.statements-container').hide();
    $('#statement-form').show();
}

const hideStatementForm = () => {
    $('.statements-container').show();
    $('#statement-form').hide();
}

const fillupVehicleForm = (model) => {
    $('#vehicle-driver_lastname').val(model.driver_lastname);
    $('#vehicle-driver_firstname').val(model.driver_firstname);
    $('#vehicle-driver_middlename').val(model.driver_middlename);
    $('#vehicle-driver_suffix').val(model.driver_suffix);
    $('#vehicle-driver_address').val(model.driver_address);
    $('#vehicle-driver_email').val(model.driver_email);
    $('#vehicle-driver_contact_no').val(model.driver_contact_no);
    $('#vehicle-driver_alt_contact_no').val(model.driver_alt_contact_no);
    $('#vehicle-plate_no').val(model.plate_no);
    $('#vehicle-class').val(model.class);
    $('#vehicle-color').val(model.color);
    $('#vehicle-make').val(model.make);
    $('#vehicle-model').val(model.model);
    $('#vehicle-year').val(model.year);
    $('#vehicle-type_of_cargo').val(model.type_of_cargo);
    $('#vehicle-insurance_company').val(model.insurance_company);
    $('#vehicle-insurance_type').val(model.insurance_type);
    $('#vehicle-insurance_status').val(model.insurance_status).selectpicker('refresh');
    $('#vehicle-coverage_start_date').val(model.coverage_start_date);
    $('#vehicle-coverage_end_date').val(model.coverage_end_date);
    $('#vehicle-or_no').val(model.or_no);
    $('#vehicle-or_no_date_issued').val(model.or_no_date_issued);
    $('#vehicle-cr_no').val(model.cr_no);
    $('#vehicle-cr_no_date_issued').val(model.cr_no_date_issued);
    $('#vehicle-company_name').val(model.company_name);
    $('#vehicle-company_contact_no').val(model.company_contact_no);
    $('#vehicle-company_address').val(model.company_address);
    $('#vehicle-statement').val(model.statement);
    $('#vehicle-type').val(model.type);

    $('#vehicle-or_photo').val(model.or_photo);
    $('.or_photo').attr('src', model.orPhoto);

    $('#vehicle-cr_photo').val(model.cr_photo);
    $('.cr_photo').attr('src', model.crPhoto);

    $('#vehicle-driver_license_front').val(model.driver_license_front);
    $('.driver_license_front').attr('src', model.dlfPhoto);

    $('#vehicle-driver_license_back').val(model.driver_license_back);
    $('.driver_license_back').attr('src', model.dlbPhoto);

    $('#vehicle-signature').val(model.signature);
    $('.signature').attr('src', (model.signature ? model.signature: app.defaultImageUrl));

    if (model.is_commercial == 1) {
        $('.is_commercial[value="1"]').prop('checked', true);
    }
    else {
        $('.is_commercial[value="0"]').prop('checked', true);
    }

    $('#vehicle-form').attr('action', model.updateUrl + '?redirect=referrer');
}

$('.btn-add-statement').click(function() {
    const form = $('#statement-form');
    form.attr('action', form.attr('create-url'));
    form.yiiActiveForm('resetForm');
    form[0].reset();

    showStatementForm();
});

$('.btn-cancel-add-statement').click(function() {
    hideStatementForm();
});


$('.btn-add-vehicle').click(function() {
    const form = $('#vehicle-form');
    form.attr('action', form.attr('create-url'));
    form.yiiActiveForm('resetForm');
    form[0].reset();

    $('.or_photo').attr('src', app.defaultImageUrl);
    $('.cr_photo').attr('src', app.defaultImageUrl);
    $('.driver_license_front').attr('src', app.defaultImageUrl);
    $('.driver_license_back').attr('src', app.defaultImageUrl);
    $('.driver-signature').attr('src', app.defaultImageUrl);

    $('#vehicle-or_photo').val('');
    $('#vehicle-cr_photo').val('');
    $('#vehicle-driver_license_front').val('');
    $('#vehicle-driver_license_back').val('');
    $('#vehicle-signature').val('');

    showVehicleForm();
});

$('.btn-add-passenger').click(function() {
    const form = $('#passenger-form');
    form.attr('action', form.attr('create-url'));
    form.yiiActiveForm('resetForm');
    form[0].reset();

    $('.signature').attr('src', app.defaultImageUrl);
    $('#passenger-signature').val('');

    showPassengerForm();
});

$('.btn-cancel-add-passenger').click(function() {
    hidePassengerForm();
});

$('.btn-cancel-add-vehicle').click(function() {
    hideVehicleForm();
});

$('.btn-update-vehicle').click(function(e) {
    const form = $('#vehicle-form');
    form.yiiActiveForm('resetForm');
    e.preventDefault();

    KTApp.block('#tbl-vehicles', {
        overlayColor: '#000000',
        message: 'Please wait',
        state: 'primary'
    });

    const id = $(this).data('id');

    $.ajax({
        url: app.baseUrl + 'vehicle/view',
        data:{id},
        dataType: 'json',
        success: (s) => {
            if (s.status == 'success') {
                fillupVehicleForm(s.model);
                showVehicleForm();
            }
            else {
                Swal.fire('Error', s.errorSummary, 'error');
            }
        },
        error: (e) => {
            Swal.fire('Error', e.responseText, 'error');
        },
        complete: (c) => {
            KTApp.unblock('#tbl-vehicles');
        }
    });
});


const fillupPassengerForm = (model) => {
    $('#passenger-vehicle_id').val(model.vehicle_id).selectpicker('refresh');
    $('#passenger-last_name').val(model.last_name);
    $('#passenger-first_name').val(model.first_name);
    $('#passenger-middle_name').val(model.middle_name);
    $('#passenger-suffix_name').val(model.suffix_name);
    $('#passenger-sex').val(model.sex).selectpicker('refresh');
    $('#passenger-age').val(model.age);
    $('#passenger-address').val(model.address);
    $('#passenger-email').val(model.email);
    $('#passenger-contact_no').val(model.contact_no);
    $('#passenger-alternate_contact_no').val(model.alternate_contact_no);
    $('#passenger-health_condition').val(model.health_condition);
    $('#passenger-medical_complaint').val(model.medical_complaint);
    $('#passenger-condition').val(model.condition).selectpicker('refresh');
    $('#passenger-observation').val(model.observation);
    $('#passenger-preferred_by').val(model.preferred_by);
    $('#passenger-noted_by').val(model.noted_by);
    $('#passenger-date').val(model.date);
    $('#passenger-statement').val(model.statement);

    $('#passenger-signature').val(model.signature);
    $('.signature').attr('src', (model.signature ? model.signature: app.defaultImageUrl));

    $('#passenger-form').attr('action', model.updateUrl + '?redirect=referrer');
}

$('.btn-update-passenger').click(function(e) {
    const form = $('#passenger-form');
    form.yiiActiveForm('resetForm');
    e.preventDefault();

    KTApp.block('#tbl-passengers', {
        overlayColor: '#000000',
        message: 'Please wait',
        state: 'primary'
    });

    const id = $(this).data('id');

    $.ajax({
        url: app.baseUrl + 'passenger/view',
        data:{id},
        dataType: 'json',
        success: (s) => {
            if (s.status == 'success') {
                fillupPassengerForm(s.model);
                showPassengerForm();
            }
            else {
                Swal.fire('Error', s.errorSummary, 'error');
            }
        },
        error: (e) => {
            Swal.fire('Error', e.responseText, 'error');
        },
        complete: (c) => {
            KTApp.unblock('#tbl-passengers');
        }
    });
});


const fillupStatementForm = (model) => {
    $('#statement-date').val(model.date);
    $('#statement-type').val(model.type).selectpicker('refresh');
    $('#statement-name').val(model.name);
    $('#statement-position').val(model.position);
    $('#statement-address').val(model.address);
    $('#statement-contact_info').val(model.contact_info);
    $('#statement-statement').val(model.statement);

    $('#statement-signature').val(model.signature);
    $('.signature').attr('src', (model.signature ? model.signature: app.defaultImageUrl));

    $('#statement-form').attr('action', model.updateUrl + '?redirect=referrer');
}
$('.btn-update-statement').click(function(e) {
    const form = $('#statement-form');
    form.yiiActiveForm('resetForm');
    e.preventDefault();

    KTApp.block('#tbl-statements', {
        overlayColor: '#000000',
        message: 'Please wait',
        state: 'primary'
    });

    const id = $(this).data('id');

    $.ajax({
        url: app.baseUrl + 'statement/view',
        data:{id},
        dataType: 'json',
        success: (s) => {
            if (s.status == 'success') {
                fillupStatementForm(s.model);
                showStatementForm();
            }
            else {
                Swal.fire('Error', s.errorSummary, 'error');
            }
        },
        error: (e) => {
            Swal.fire('Error', e.responseText, 'error');
        },
        complete: (c) => {
            KTApp.unblock('#tbl-statements');
        }
    });
});

$('#tbl-vehicles').DataTable();
$('#tbl-passengers').DataTable();
$('#tbl-statements').DataTable();