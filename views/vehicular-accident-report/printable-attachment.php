<?php

use app\helpers\App;
use app\models\search\VehicularAccidentReportSearch;
use app\widgets\Anchors;

$this->title = 'Post Accident Report(Attachment):' . $model->mainAttribute;
$this->params['sleep'] = 2000; 
$this->params['withHeader'] = false;
$this->params['size'] = 'landscape';
$this->addCssFile('css/vehicular-accident-report');
$this->registerJs(<<< JS
    KTApp.block('body', {
        overlayColor: '#000000',
        message: 'Loading map...',
        state: 'primary'
    });
    setTimeout(function() {
        KTApp.unblockPage();
    }, 1000);
JS);
?>

<div id="printable" class="printable-attachment">
    <table width="100%" class="border-0">
        <thead>
            <tr class="border-0">
                <td class="border-0">
                    <?= $this->render('printable/header', ['model' => $model])?>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr class="border-0">
                <td class="border-0">
                    <?= $this->render('printable/attachments', ['model' => $model]) ?>
                    <?= $this->render('printable/photos-of-accident', ['model' => $model]) ?>
                    <?= $this->render('printable/other-damages', ['model' => $model]) ?>
                    <?= $this->render('printable/sketch', ['model' => $model]) ?>
                    <?= $this->render('printable/map-vicinity', ['model' => $model]) ?>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="border-0">
                <td class="border-0">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td class="p-bh">
                                    <span>
                                        <?= $model->code ?>
                                    </span>
                                </td>
                                <td class="p-bh p-text-right">
                                    <span>Date Generated: <?= $model->generatedDate ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
                                    
                                    
                                    
                                    
                                    