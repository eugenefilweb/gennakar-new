<?php

use app\helpers\App;
use app\helpers\Html;
use app\models\Barangay;
use app\models\File;
use app\models\HazardMap;
use app\widgets\ActiveForm;
use app\widgets\BootstrapSelect;
use app\widgets\DataList;
use app\widgets\DatePicker;
use app\widgets\DateTimePicker;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;
use app\widgets\InputList;
use app\widgets\OpenLayer;


/* @var $this yii\web\View */
/* @var $model app\models\PostAccidentReport */
/* @var $form app\widgets\ActiveForm */
$this->registerCss(<<< CSS
	#post-accident-report-form table .form-group {margin-bottom: 0;}
CSS);

$barangays = HazardMap::barangayJsonData();

$this->registerJs(<<< JS
	const barangays = {$barangays},
		BARANGAY = 1;

	$('#postaccidentreport-barangay').on('change', function(e) {
		const barangayName = $(this).val();
		if (barangayName) {
			KTApp.block('.map-photo-container', {
				overlayColor: '#000000',
				message: 'Loading image',
				state: 'primary'
			});

			const selectedBarangay = barangays.find(barangay => barangay.name == barangayName && barangay.type == BARANGAY);
			if (selectedBarangay) {
				$('.map-photo').attr('src', selectedBarangay.imageUrl);
				$('#postaccidentreport-map').val(selectedBarangay.photo);
			}
			setTimeout(() => {
				KTApp.unblock('.map-photo-container');
			}, 1500);
		}
	});

	const computeAge = (birthdate) => {
		var dob = new Date(birthdate);  
	    //calculate month difference from current date in time  
	    var month_diff = Date.now() - dob.getTime();  
	      
	    //convert the calculated difference in date format  
	    var age_dt = new Date(month_diff);   
	      
	    //extract year from date      
	    var year = age_dt.getUTCFullYear();  
	      
	    //now calculate the age of the user  
	    var age = Math.abs(year - 1970);  
      	

      	return age;
	}
	$('#postaccidentreport-date_of_birth').on('change', function() {
		let date = $(this).val(),
			currentAge = computeAge(date);

		$('#postaccidentreport-age').val(currentAge);
	})
JS);
?>
<?php $form = ActiveForm::begin(['id' => 'post-accident-report-form']); ?>
    <div class="row">
        <div class="col-md-6">
			<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'MAIN INFORMATION',
				'stretch' => true
			]) ?>
                <div class="row">
		            <div class="col-md-6">
		                <?= $form->field($model, 'control_no')->textInput(['maxlength' => true]) ?>
		            </div>
		            <div class="col-md-6">
		                <?= DataList::widget([
							'form' => $form,
							'model' => $model,
							'attribute' => 'type_of_accident',
							'data' => App::params('type_of_accident')
						]) ?>
		            </div>
		        </div>
                <div class="row">
		            <div class="col-md-6">
		        		<?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
		            </div>
		            <div class="col-md-6">
		            	<?= BootstrapSelect::widget([
							'form' => $form,
							'model' => $model,
							'attribute' => 'barangay',
							'data' => HazardMap::dropdown('name', 'name', ['type' => HazardMap::BARANGAY])
						]) ?>
		            </div>
		        </div>

		        <div class="row datapicker-row">
		            <div class="col-md-6">
		                <?= DateTimePicker::widget([
							'form' => $form,
							'model' => $model,
							'attribute' => 'date_time',
						]) ?>
		            </div>
		            <div class="col-md-6">
		            	<?= DataList::widget([
							'form' => $form,
							'model' => $model,
							'attribute' => 'weather_condition',
							'data' => [
		            	 		'Sunny' => 'Sunny', 
		            	 		'Cloudy' => 'Cloudy', 
		            	 		'Windy' => 'Windy', 
		            	 		'Rainy' => 'Rainy', 
		            	 		'Stormy' => 'Stormy'
							]
						]) ?>
		            </div>
		        </div>

        	<?php $this->endContent() ?>
        </div>
        <div class="col-md-6">
	        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'PARTICIPANTS',
				'stretch' => true
			]) ?>
				<table class="table table-borderless">
					<tbody>
						<tr>
							<td class="pl-0">Participants</td>
							<td width="30%">
								<?= $form->field($model, 'participant_male')->textInput([
									'placeholder' => 'Total Male'
								])->label(false) ?>
							</td>
							<td width="30%" class="pr-0">
								<?= $form->field($model, 'participant_female')->textInput([
									'placeholder' => 'Total Female'
								])->label(false) ?>
							</td>
						</tr>

						<tr>
							<td class="pl-0">Local Government Responders</td>
							<td>
								<?= $form->field($model, 'local_male')->textInput([
									'placeholder' => 'Total Male'
								])->label(false) ?>
							</td>
							<td class="pr-0">
								<?= $form->field($model, 'local_female')->textInput([
									'placeholder' => 'Total Female'
								])->label(false) ?>
							</td>
						</tr>
						<tr>
							<td class="pl-0">National Government Responders</td>
							<td>
								<?= $form->field($model, 'national_male')->textInput([
									'placeholder' => 'Total Male'
								])->label(false) ?>
							</td>
							<td class="pr-0">
								<?= $form->field($model, 'national_female')->textInput([
									'placeholder' => 'Total Female'
								])->label(false) ?>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="pb-0 pl-0 pr-0">
								<p class="mt-10 font-weight-bold mb-0">Others: (Specify)</p>
							</td>
						</tr>
						<tr>
							<td class="pl-0">
								<?= $form->field($model, 'other_name')->textInput([
									'placeholder' => 'Description of Benificiary'
								])->label(false) ?>
							</td>
							<td>
								<?= $form->field($model, 'other_male')->textInput([
									'placeholder' => 'Total Male'
								])->label(false) ?>
							</td>
							<td class="pr-0">
								<?= $form->field($model, 'other_female')->textInput([
									'placeholder' => 'Total Female'
								])->label(false) ?>
							</td>
						</tr>
					</tbody>
				</table>
	        <?php $this->endContent() ?>
	    </div>
    </div>

    <div class="row">
    	<div class="col-md-6">
    		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'PERSONS INVOLVED',
				'stretch' => true
			]) ?>
		        <label class="mb-0">Person(s) of Interest</label>
		        <label class="text-muted form-text mt-0">
		        	Apparent or alleged victims, parties, or participants to the accident as reported by official MDRRMO responders
		        </label>
		        <?= InputList::widget([
					'label' => 'Person of Interest',
					'name' => 'PostAccidentReport[persons_of_interest][]',
					'data' => $model->persons_of_interest,
				]) ?>

		        <div class="my-10"></div>
		        <label class="mb-0">Responder(s)</label>
		        <label class="text-muted form-text mt-0">
		        	MDRRMO Personnel
		        </label>
		        <?= InputList::widget([
					'label' => 'Responder',
					'name' => 'PostAccidentReport[responders][]',
					'data' => $model->responders,
				]) ?>

		        <div class="my-10"></div>
		        <label class="mb-0">Witness(es)</label>
		        <label class="text-muted form-text mt-0">
		        	Persons that may provide additional information, source of first-hand information or corroborate facts of the accident
		        </label>
		        <?= InputList::widget([
					'label' => 'Witness',
					'name' => 'PostAccidentReport[witnesses][]',
					'data' => $model->witnesses,
				]) ?>
	        <?php $this->endContent() ?>
		</div>
    	<div class="col-md-6">
    		<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'RESCUE PERFORMED',
				'stretch' => true
			]) ?>
                <div class="row">
                	<div class="col-md-9">
                <?= $form->field($model, 'name_of_rescuee')->textInput(['maxlength' => true]) ?>
                	</div>
                	<div class="col-md-3">
                <?= $form->field($model, 'sex')->dropDownList(App::keyMapParams('gender')) ?>
                	</div>
                </div>

                <div class="row">
                	<div class="col-md-9">
                		<?= DatePicker::widget([
		                	'form' => $form,
		                	'model' => $model,
		                	'attribute' => 'date_of_birth',
		                ]) ?>
                	</div>
                	<div class="col-md-3">
                		<?= $form->field($model, 'age')->textInput([
                			'readonly' => true
                		]) ?>
                	</div>
                </div>

                <?= $form->field($model, 'street_address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'barangay_address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'pre_existing_condition')->textInput(['maxlength' => true]) ?>

		        <?= $form->field($model, 'accident_report')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'prepared_by')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'verified_by')->textInput(['maxlength' => true]) ?>
	        <?php $this->endContent() ?>
		</div>
    </div>

    <div class="row">
	    <div class="col-md-6">
	        <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
				'title' => 'COMMENTS / REMARKS',
				'stretch' => true
			]) ?>
		        <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
		        <?= $form->field($model, 'comments_by')->textInput(['maxlength' => true]) ?>
		        <?= $form->field($model, 'officer_in_charge')->textInput(['maxlength' => true]) ?>
		        <?= $form->field($model, 'noted_by')->textInput([
		        	'maxlength' => true,
		        	'placeholder' => 'Municipal Mayor'
		        ]) ?>
		        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
	        	<?= $form->field($model, 'social_media_link')->textInput(['maxlength' => true]) ?>
	        <?php $this->endContent() ?>
	    </div>
	    <div class="col-md-6">
		    <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		    	'title' => 'MAP PICTURE',
				'stretch' => true
			]) ?>
		        <div class="text-center map-photo-container">
		            <?= Html::image($model->map, ['w' => 500], [
						'class' => 'img-thumbnail map-photo',
						'loading' => 'lazy',
					] ) ?>

		            <div class="mt-5">
		                <?= ImageGallery::widget([
							'tag' => 'Post Accident Report',
							'widthSource' => 500,
							'model' => $model,
							'attribute' => 'map',
							'ajaxSuccess' => <<< JS
								if(s.status == 'success') {
									$('.map-photo').attr('src', s.src);
								}
							JS,
						]) ?>
		            </div>
		        </div>
	        <?php $this->endContent() ?>
	    </div>
    </div>

    <?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'PHOTOS',
	]) ?>
		<div class="row">
			<div class="col-md-6">
				<?= Dropzone::widget([
			        'tag' => 'Post Accident Report',
			        'files' => $model->photo1File ? [$model->photo1File]: [],
			        'maxFiles' => 1,
			        'model' => $model,
			        'attribute' => 'photo1',
			        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
			    ]) ?>
			</div>
			<div class="col-md-6">
				<?= Dropzone::widget([
			        'tag' => 'Post Accident Report',
			        'files' => $model->photo2File ? [$model->photo2File]: [],
			        'maxFiles' => 1,
			        'model' => $model,
			        'attribute' => 'photo2',
			        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
			    ]) ?>
			</div>
		</div>
		<div class="my-5"></div>
		<div class="row">
			<div class="col-md-6">
				<?= Dropzone::widget([
			        'tag' => 'Post Accident Report',
			        'files' => $model->photo3File ? [$model->photo3File]: [],
			        'maxFiles' => 1,
			        'model' => $model,
			        'attribute' => 'photo3',
			        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
			    ]) ?>
			</div>
			<div class="col-md-6">
				<?= Dropzone::widget([
			        'tag' => 'Post Accident Report',
			        'files' => $model->photo4File ? [$model->photo4File]: [],
			        'maxFiles' => 1,
			        'model' => $model,
			        'attribute' => 'photo4',
			        'acceptedFiles' => array_map(fn($val) => ".{$val}", File::EXTENSIONS['image'])
			    ]) ?>
			</div>
		</div>
	<?php $this->endContent() ?>

	<?php $this->beginContent('@app/views/layouts/_card_wrapper.php', [
		'title' => 'Map Vicinity Coordinates',
	]) ?>
		<?= OpenLayer::widget([
			'zoom' => 16,
			'latitude' => $model->latitude,
			'longitude' => $model->longitude,
			'clickCallback' => <<< JS
				$('#postaccidentreport-latitude').val(lat);
				$('#postaccidentreport-longitude').val(lon);
			JS
		]) ?>
	    <div class="row mt-10">
	        <div class="col-md-6">
	            <?= $form->field($model, 'latitude')->textInput([
	                'maxlength' => true
	            ]) ?>
	        </div>
	        <div class="col-md-6">
	            <?= $form->field($model, 'longitude')->textInput([
	                'maxlength' => true
	            ]) ?>
	        </div>
	    </div>
	<?php $this->endContent() ?>

    <div class="form-group">
		<?= ActiveForm::buttons() ?>
    </div>
<?php ActiveForm::end(); ?>

