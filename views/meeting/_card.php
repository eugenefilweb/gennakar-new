<div class="card">
    <div class="card-header">
        <div class="card-title collapsed" 
            data-toggle="collapse" 
            data-target="#collapse-<?= $model->slug ?>">
            <?= $model->name ?> &nbsp;
            <small style="margin-top: 6px;">
                <?= $model->typeBadge ?>
            </small>
            &nbsp;&nbsp;
            <div class="text-dark-50"><?= $model->createdAt ?></div>
        </div>
    </div>
    <div id="collapse-<?= $model->slug ?>" class="collapse" 
        data-parent="#minutes-accordion">
        <div class="card-body">
            <?= $model->filePreviews($model->{$attribute}) ?>
        </div>
    </div>
</div>