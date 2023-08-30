<?= \app\widgets\FileExplorer::widget([
    'tag' => 'Toolkit Guide',
    'breadcrumbs' => [
        [
            'folderName' => 'Documents',
            'folderPath' => 'Toolkit Guide'
        ]
    ],
    'reloadUrl' => ['toolkit-guide/index'],
    'path' => $path,
    'template' => '_document-and-breadcrumbs',
]) ?>