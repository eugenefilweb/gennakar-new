<?php

$this->registerCss(<<< CSS
    #{$widgetId} .file-count {
        width: inherit;
        position: absolute;
        top: 0;
        font-weight: 600;
        display: block;
        cursor: pointer;
    }
    #{$widgetId} .folder-container:hover,
    #{$widgetId} .add-folder:hover {
        outline: 2px solid #1bc5bd;
        border-radius: 10px;
        cursor: pointer;
    }

    #{$widgetId} .folder-container,
    #{$widgetId} .add-folder {
        padding: 5px 15px;
        width: fit-content;
    }

    #{$widgetId} .img-folder,
    #{$widgetId} .img-create-folder {
        max-width: 100px !important;
    }
    #{$widgetId} .folder-label {
        overflow-wrap: anywhere;
    }

    #{$widgetId} ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
        background-color: #eee;
    }
    #{$widgetId} ul.breadcrumb li {
        display: inline;
        font-size: 14px;
    }
    #{$widgetId} ul.breadcrumb li+li:before {
        padding: 8px;
        color: black;
        content: "/";
    }
    #{$widgetId} ul.breadcrumb li a {
        color: #0275d8;
        text-decoration: none;
    }
    #{$widgetId} ul.breadcrumb li a:hover {
        color: #01447e;
        text-decoration: underline;
    }

CSS);

$this->registerWidgetJs($widgetFunction, <<< JS
    let currentFolder = '';

    const loadDirectories = function(el='', path='', callback = () => {}) {
        KTApp.blockPage({
            overlayColor: '#000000',
            state: 'primary',
            message: 'Please wait'    
        })
        if(el) {
            path = el.data('path');
        }
       
        $.ajax({
            url: '{$reloadUrl}',
            data: {path},
            method: 'post',
            dataType: 'json',
            success: function(s) {
                const url = new URL(location.href);
                url.searchParams.set('path', path);
                history.pushState(null, '', url);

                $('#{$widgetId} .document-and-breadcrumbs').html(s.html)
                $('[data-toggle="tooltip"]').tooltip();
                $('#table-file').DataTable({
                    destroy: true,
                    pageLength: 5,
                    order: [[0, 'desc']]
                });
                KTApp.unblockPage();
                callback();
            },
            error: (e) => {
                KTApp.unblockPage();
                alert(e.statusText)
            }
        })
    }
    $(document).on('click', '#{$widgetId} .breadcrumb-link', function(e) {
        e.preventDefault();
        loadDirectories('', $(this).data('path'))
    });

    $(document).on('dblclick', '#{$widgetId} .folder-container', function() {
        loadDirectories($(this))
    });

    $(document).on('contextmenu', '#{$widgetId} .folder-container', function(e) {
        e.preventDefault();
        currentFolder = $(this).data('path');

        const folderName = $(this).find('.folder-label').html();
        $('#modal-delete-folder .modal-title').html('Folder: ' + folderName);
        $('#modal-delete-folder').modal('show');
    });

    $('.btn-delete-folder').click(function() {
        KTApp.block('#modal-delete-folder .modal-body', {
            overlayColor: '#000000',
            message: 'Deleting folder...',
            state: 'warning',
        });

        $.ajax({
            url: app.baseUrl + 'file/delete-folder',
            data: { path: currentFolder },
            method: 'post',
            dataType: 'json',
            success: (s) => {
                if (s.status == 'success') {
                    const url = new URL(location.href);
                    loadDirectories('', url.searchParams.get('path'), () => {
                        Swal.fire('Success', s.message, 'success');
                    });
                }
                else {
                    Swal.fire('Error', s.message, 'error');
                }

                $('#modal-delete-folder').modal('hide');
                KTApp.unblock('#modal-delete-folder .modal-body');
            },
            error: (e) => {
                Swal.fire('Error', e.responseText, 'error');
                KTApp.unblock('#modal-delete-folder .modal-body');
                $('#modal-delete-folder').modal('hide');
            }
        })
    });

    $(document).on('click', '#{$widgetId} .btn-remove-file', function() {
        var self = this;
        Swal.fire({
            title: "Are you sure?",
            text: "You won\"t be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {

                KTApp.block('body', {
                    overlayColor: '#000000',
                    state: 'warning',
                    message: 'Please wait...'
                });
                $.ajax({
                    url: app.baseUrl + 'file/delete?token=' + $(self).data('token'),
                    method: 'post',
                    dataType: 'json',
                    success: function(s) {
                        if(s.status == 'success') {
                            $('#{$widgetId} #table-file').DataTable({
                                destroy: true,
                                pageLength: 5,
                                order: [[0, 'desc']]
                            }).row($(self).closest('tr')).remove().draw();
                            Swal.fire({
                                icon: "success",
                                title: "Deleted",
                                text: "Your file has been deleted.",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        else {
                            Swal.fire('Error', s.errors, 'error');
                        }
                        KTApp.unblock('body');
                    },
                    error: function(e) {
                        Swal.fire('Error', e.responseText, 'error');
                        KTApp.unblock('body');
                    },
                })
            }
        });
    });

    $(document).on('click', '#{$widgetId} .btn-edit-file', function() {
        let file = $(this);

        KTApp.block('#{$widgetId}', {
            state: 'warning', // a bootstrap color
            message: 'Please wait...',
        });

        $.ajax({
            url: app.baseUrl + 'file/view',
            method: 'get',
            data: {
                token: file.data('token'),
                template: '_form-ajax',
            },
            dataType: 'json',
            success: function(s) {
                if(s.status == 'success') {
                    $('#{$widgetId} #modal-edit-document .modal-body').html(s.form);
                    $('#{$widgetId} #modal-edit-document').modal('show');
                }
                else {
                    Swal.fire('Error', s.error, 'error');
                }
                KTApp.unblock('#{$widgetId}');
            },
            error: function(e) {
                Swal.fire('Error', e.responseText, 'error');
                KTApp.unblock('#{$widgetId}');
            }
        });
    });

    $(document).on('click', '#{$widgetId} .add-folder', function() {
        let path = $(this).data('path');
        $('#{$widgetId} #folder-path').val(path)

        $('#{$widgetId} #modal-add-folder').modal('show');
    });

    $('#{$widgetId} #btn-add-folder').click(function() {
        const folderPath = $('#{$widgetId} #folder-path').val();
        const folderName = $('#{$widgetId} #folder-name').val();

        var _this = this;
        $.ajax({
            url: '{$addFolderUrl}',
            data: {
                folderPath,
                folderName,
            },
            method: 'post',
            dataType: 'json',
            success: (s) => {
                $('#{$widgetId} #folder-path').val('');
                $('#{$widgetId} #folder-name').val('');
                $('#{$widgetId} #modal-add-folder').modal('hide');

                loadDirectories('', folderPath);
            }
        });
    });
JS);

?>

<div id="<?= $widgetId ?>" class="file-explorer-widget">
    <div class="document-and-breadcrumbs">
        <?= $this->render('_document-and-breadcrumbs', [
            'breadcrumbs' => $breadcrumbs,
            'directories' => $directories,
            'files' => $files,
            'path' => $path,
            'reloadUrl' => $reloadUrl,
            'widgetId' => $widgetId,
            'folderImage' => $folderImage,
            'addFolderImage' => $addFolderImage,
            'tag' => $tag,
        ]) ?>
    </div>
            

    <div class="modal fade" id="modal-edit-document" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rename File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-add-folder" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="" id="folder-path">
                    <input type="text" name="" id="folder-name" class="form-control form-control-lg" placeholder="Enter folder name">
                    <button class="btn btn-success font-weight-bolder btn-block mt-5" id="btn-add-folder">CREATE FOLDER</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-delete-folder" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Action Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn-delete-folder btn btn-danger font-weight-bolder btn-block mt-5">DELETE FOLDER</button>
                </div>
            </div>
        </div>
    </div>
</div>
