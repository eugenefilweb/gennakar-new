<?php
$actions = $actions ?? [
    'view',
    'edit',
    'delete'
];
?>
<div class="btn-group" role="group" aria-label="Basic example">

    <?php if (in_array('view', $actions)): ?>
        <a href="<?= $model->viewerUrl ?>" target="_blank" class="btn btn-light-primary btn-sm btn-icon btn-view-file">
            <i class="fa fa-eye"></i>
        </a>
    <?php endif ?>

    <?php if (in_array('edit', $actions)): ?>
        <button data-token="<?= $model->token ?>" data-name="<?= $model->name ?>" type="button" class="btn btn-light-warning btn-sm btn-icon btn-edit-file">
            <i class="fa fa-edit"></i>
        </button>
    <?php endif ?>
    
    <?php if (in_array('delete', $actions)): ?>
        <button type="button" data-token="<?= $model->token ?>" class="btn btn-light-danger btn-sm btn-icon btn-remove-file" data-delete-url="<?= $model->deleteUrl ?>">
            <i class="fa fa-trash"></i>
        </button>
    <?php endif ?>
</div>