<?php

use app\helpers\App;

$this->registerJsFile("{$path}markerjs2.js");

$this->registerJs(<<< JS
    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => {
            target.src = event.dataUrl
            $('#sampleImage').show();
        } );

        markerArea.show();
    }

    const sampleImage = document.getElementById("sampleImage");
    showMarkerArea(sampleImage);
    sampleImage.addEventListener("click", () => {
        showMarkerArea(sampleImage);
        $('#sampleImage').hide();
    });
    $('#sampleImage').hide();
JS);

$this->registerCss(<<< CSS
    #app {
      width: 100vw;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #sampleImage {
        min-width: 700px;
      max-width: 100%;
      max-height: 80%;
    }

CSS);
?>


<div id="app">
  <img id="sampleImage" src="<?= $file->absoluteLocation ?>" crossorigin="anonymous" class="img-fluid"/>
</div>

