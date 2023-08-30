<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\File;

$this->title = 'Files | Others';
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel; 
$this->params['activeMenuLink'] = '/file/other';


$buttons = App::foreach(
    App::params('other_plans'), 
    fn ($plan) => Html::tag('a', $plan['label'], [
        'class' => 'dropdown-item btn-add-file pointer',
        'data-tag' => $plan['label']
    ])
);

$this->params['headerButtons'] = <<< HTML
    <div class="dropdown">
        <button class="btn btn-success font-weight-bold dropdown-toggle" type="button" id="btn-upload" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Upload File
        </button>
        <div class="dropdown-menu" aria-labelledby="btn-upload">
            {$buttons}
        </div>
    </div>
HTML;

$this->registerCss(<<< CSS
    .app-border:hover {
        cursor: pointer;
        box-shadow: rgb(0 0 0 / 30%) 0px 1px 20px 0 !important;
    }
    .bg-diagonal-light-success:hover {outline: 3px solid #1BC5BD !important;}
    .bg-diagonal-light-primary:hover {outline: 3px solid #3699FF !important;}
    .bg-diagonal-light-info:hover {outline: 3px solid #3699FF !important;}
    .bg-diagonal-light-secondary:hover {outline: 3px solid #E4E6EF !important;}
    .bg-diagonal-light-danger:hover {outline: 3px solid #F64E60 !important;}
    .bg-diagonal-light-warning:hover {outline: 3px solid #FFA800 !important;}
CSS);
$this->registerjs(<<< JS
    const getUploadForm = (tag) => {
        KTApp.blockPage({
            overlayColor: '#000',
            message: 'Loading Form...',
            state: 'primary'
        });
        $.ajax({
            url: app.baseUrl + 'file/upload-form-by-tag',
            data: { tag },
            method: 'get',
            dataType: 'json',
            success: (s) => {
                if (s.status == 'success') {
                    $('#modal-upload .modal-title').html('Upload ' + tag);
                    $('#modal-upload .modal-body').html(s.form);
                    $('#modal-upload').modal('show');
                }

                KTApp.unblockPage();
            },
            error: (e) => {
                console.log('getUploadForm', e);
                KTApp.unblockPage();
            }
        });
    }

    const viewFile = (tag) => {
        KTApp.blockPage({
            overlayColor: '#000',
            message: 'Loading Files...',
            state: 'primary'
        });
        $.ajax({
            url: app.baseUrl + 'file/view-by-tag',
            data: { tag },
            method: 'get',
            dataType: 'json',
            success: (s) => {
                if (s.status == 'success') {
                    $('#modal-view .modal-title').html('Files: ' + tag);
                    $('#modal-view .modal-body').html(s.files);
                    $('#modal-view').modal('show');
                }
                KTApp.unblockPage();
            },
            error: (e) => {
                console.log('viewFile', e);
                KTApp.unblockPage();
            }
        });
    }

    $('.btn-add-file').click(function() {
        const tag = $(this).data('tag');
        getUploadForm(tag);
    });

    $('.btn-view-file').click(function(e) {
        e.preventDefault();
        const tag = $(this).data('tag');
        viewFile(tag);
    });
JS);
?>
 
<div class="file-other-index-page row">
    <?= App::foreach(App::params('other_plans'), function($plan, $index) {
        $total = (new File())->getTotalByTag($plan['label']);
        return <<< HTML
            <div class="col-md-4 mb-10">
                <div data-toggle="tooltip" title="{$plan['description']}" class="card card-custom card-stretch bg-diagonal bg-diagonal-light-{$plan['class']} app-border directory-card" data-url="">
                    <div class="card-body">
                        <a href="" class="h4 text-dark text-hover-{$plan['class']}">
                            {$plan['description']}
                        </a>
                        <div class="d-flex my-5 justify-content-between align-items-center">
                            <div class="">
                                <div class="text-dark-50 mt-3" style="font-size: 14px;">
                                    <div>
                                        <p class="lead font-weight-bold display-3 text-{$plan['class']}">
                                            {$plan['label']}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <a class="btn font-weight-bolder text-uppercase btn-outline-{$plan['class']} btn-lg float-right btn-view-file" href="#" data-tag="{$plan['label']}">
                                    <i class="fa fa-eye"></i> 
                                    VIEW
                                </a>
                            </div>
                        </div>

                        <div class="font-weight-bolder text-black-50 text-right" style="font-size:12px">
                            <em>Total Files: <span class="file-total-{$plan['label']}">{$total}</span></em>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }) ?>
</div>


<div class="modal fade" id="modal-upload" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-view" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>