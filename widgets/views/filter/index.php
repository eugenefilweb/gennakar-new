<?php 

use app\helpers\Url;

$mapbox_url = Url::to('map-ajax');

// $attribute = json_encode($attribute);
// $name = json_encode($name);

$script = <<<JS
$('.checkbox').on('click', function(event) {	
        event.preventDefault();

            var name = $(this).data('name');
            console.log(name);
            var attribute = $(this).data('attribute');
            console.log(attribute);
            var data = { attribute : name };

        $.ajax({
            url: '{$mapbox_url}',
            method: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                // $('#load-cart').html(response);
            }
        });
    });
JS;

$this->registerJs($script);

// print_r($inputs);
// die;
?>
<?= $title ? "<p class='mt-5 font-weight-bold'>{$title}</p>": "" ?>

<div class="checkbox-list"> 
	<?= $inputs ?>

	<label class='checkbox'>
    <input 
                type='checkbox' 
        value='Kaliwa' 
        name='watershed[]'
        data-name ='Kaliwa'
        class ='Kaliwa'
        data-attribute ='watershed'
        > 

    <span></span> Kaliwa</label>
<label class='checkbox'>
    <input 
                type='checkbox' 
        value='Kanan' 
        name='watershed[]'
        data-name ='Kanan'
        class ='Kanan'
        data-attribute ='watershed'
        > 

    <span></span> Kanan</label>
<label class='checkbox'>
    <input 
                type='checkbox' 
        value='Umiray' 
        name='watershed[]'
        data-name ='Umiray'
        class ='Umiray'
        data-attribute ='watershed'
        > 

    <span></span> Umiray</label>
<label class='checkbox'>
    <input 
        type='checkbox' 
        value='watershed' 
        name='watershed[]'
        data-name ='watershed'
        class ='watershed'
        data-attribute ='watershed'
        > 

    <span></span> watershed</label>
</div>