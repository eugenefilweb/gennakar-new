<?php

use app\helpers\App;
use app\helpers\Html;
use app\widgets\AnchorBack;

$this->title = "File Draw: {$model->name}";

$this->registerJsFile(App::publishedUrl('/markerjs2/', Yii::getAlias('@app/assets')) . "markerjs2.js");

$this->registerJs(<<< JS
    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => {
            target.src = event.dataUrl
            $('#sampleImage').show();
        });

        markerArea.addEventListener("beforeclose", (event) => {
            let ok = confirm('Discard Changes');

            if(ok) {
                target.src = '{$model->absoluteLocation}'
                $('#sampleImage').show();
            }
            else {
                event.preventDefault();
            }
        });

        markerArea.show();
    }

    const sampleImage = document.getElementById("sampleImage");
    showMarkerArea(sampleImage);
    sampleImage.addEventListener("click", () => {
        showMarkerArea(sampleImage);
    });
    $('#sampleImage').hide();


    function download(source){
        var el = document.createElement("a");
        el.setAttribute("href", source);
        el.setAttribute("download", '{$model->nameWithExtension}');
        document.body.appendChild(el);
        el.click();
        el.remove();
    }

    $('#download-file').click(function() {
        let source =  $('#sampleImage').attr('src');
        download(source);
    })
JS);

$this->registerCss(<<< CSS
    #app {
        margin-top: 5rem;
        width: 100vw;
        height: 100vh;
        text-align: center;
        vertical-align: middle;
        width: 95vw;
    }
    #sampleImage {
        min-width: 700px;
        max-width: 100%;
        max-height: 80%
    }
    .gutter-b {
        margin-bottom: 0;
    }
    th {
        white-space: nowrap;
    }
CSS);
?>

<div class="d-flex">
     <div id="app">
        <img id="sampleImage" src="<?= $model->absoluteLocation ?>" crossorigin="anonymous" class="img-fluid"/>
    </div>
        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
            'title' => 'Image Properties',
            'toolbar' => <<< HTML
                <div class="card-toolbar">
                    <a href="{$model->displayPath}" class="font-weight-bolder btn btn-sm btn-outline-primary">Full Screen</a>
                </div>
            HTML
        ]); ?>
            <table class="table-bordered table">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td> <?= $model->name ?> </td>
                    </tr>
                    <tr>
                        <th>Extension</th>
                        <td> <?= $model->extension ?> </td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td> <?= $model->fileSize ?> </td>
                    </tr>
                    <tr>
                        <th>Width</th>
                        <td> <?= $model->width ?> </td>
                    </tr>
                    <tr>
                        <th>Height</th>
                        <td> <?= $model->height ?> </td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td> <?= $model->location ?> </td>
                    </tr>
                    <tr>
                        <th>Token</th>
                        <td> <?= $model->token ?> </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td> <?= App::formatter('asFulldate', $model->created_at) ?> </td>
                    </tr>
                    <tr>
                        <th>Created by</th>
                        <td> <?= $model->createdByEmail ?> </td>
                    </tr>
                </tbody>
            </table>

            <div class="action-buttons mt-5">
                <div class="btn-group">
                    <div>
                        <?= AnchorBack::widget([
                            'title' => '<i class="fa fa-angle-left"></i> Back',
                            'options' => [
                                'class' => 'btn btn-secondary font-weight-bold',
                                // 'data-original-title' => 'Go back',
                                // 'data-toggle' => "tooltip",
                                'data-theme' => "dark",
                            ]
                        ]) ?>
                        <?= Html::a('Download', '#!', [
                            'class' => 'btn btn-success font-weight-bolder',
                            'id' => 'download-file'
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php $this->endContent(); ?>
</div> 