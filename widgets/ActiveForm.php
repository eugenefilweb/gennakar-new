<?php

namespace app\widgets;

use app\helpers\App;
use app\helpers\Html;
use app\models\Theme;
use app\widgets\AnchorForm;
use app\widgets\BootstrapSelect;
use app\widgets\Checkbox;
use app\widgets\DataList;
use app\widgets\DatePicker;
use app\widgets\DateRange;
use app\widgets\DateTimePicker;
use app\widgets\Dropzone;
use app\widgets\ImageGallery;
use app\widgets\InputList;
use app\widgets\Pagination;
use app\widgets\RecordStatusInput;
use app\widgets\Search;
use app\widgets\TinyMce;


class ActiveForm extends \yii\widgets\ActiveForm
{
	public $forceClass;

	public function init()
	{
		parent::init();

		$currentTheme = App::identity('currentTheme');

		if ($currentTheme) {
			if (in_array($currentTheme->slug, Theme::KEEN)) {
				$this->errorCssClass = 'is-invalid';
				$this->successCssClass = 'is-valid';
				$this->validationStateOn = 'input';

				$this->options['class'] = 'form' . ' ' . $this->forceClass;
				$this->options['novalidate'] = 'novalidate';
			}
		}
	}

	public function search($model)
	{
		return Search::widget(['model' => $model]);
	}

	public function searchButton()
	{
		return SearchButton::widget();
	}

	public function pagination($model)
	{
		return Pagination::widget([
	        'form' => $this,
	        'model' => $model,
	    ]);
	}

	public function dropzone($model, $attribute = '', $tag = '', $options = [])
	{
		$options['model'] = $model;
		$options['attribute'] = $attribute;
		$options['tag'] = $tag;

		return Dropzone::widget($options);
	}

	public function dateRange($model)
	{
		return DateRange::widget(['model' => $model]);
	}

	public function datePicker($model, $attribute = '', $options = [])
	{
		$options['form'] = $this;
		$options['model'] = $model;
		$options['attribute'] = $attribute;

		return DatePicker::widget($options);
	}

	public function dataList($model, $attribute = '', $data=[])
	{
		return DataList::widget([
            'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data
        ]);
	}

	public function datetimePicker($model, $attribute = '')
	{
		return DateTimePicker::widget([
			'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
		]);
	}

	public static function buttons($size='md')
	{
		return AnchorForm::widget([
			'size' => $size
		]);
	}

	public static function recordStatus($params)
	{
		return RecordStatusInput::widget($params);
	}

	public function bootstrapSelect($model, $attribute = '', $data = [], $options = [])
	{
		$options['form'] = $this;
		$options['model'] = $model;
		$options['attribute'] = $attribute;
		$options['data'] = $data;

		return BootstrapSelect::widget($options);
	}

	public function checkbox($data = [], $name = '', $checkedFunction = null, $options = [])
	{
		$options['data'] = $data;
		$options['name'] = $name;
		$options['checkedFunction'] = $checkedFunction;
		
		return Checkbox::widget($options);
	}

	public function radioList($model, $attribute = '', $items = [], $options = [])
	{
		return $this->field($model, $attribute)->radioList($items, $options);
	}

	public function submitButton($title = 'Save', $options = ['class' => 'btn btn-lg btn-success font-weight-bold'])
	{
		return Html::submitButton($title, $options);
	}

	public function inputList($label = '', $name = '', $data = [])
	{
		return InputList::widget([
			'label' => $label,
			'name' => $name,
			'data' => $data,
		]);
	}

	public function imageGallery($model, $attribute = '', $tag = '', $options = [])
	{
		$image_id = $options['image_id'] ?? $attribute;

		$options['model'] = $model;
		$options['attribute'] = $attribute;
		$options['tag'] = $tag;

		$options['ajaxSuccess'] = $options['ajaxSuccess'] ?? "
			if(s.status == 'success') {
				$('[data-id=\"{$image_id}\"]').attr('src', s.src + '');
			}
		";

		return ImageGallery::widget($options);
	}

	public function tinymce($model = null, $attribute = '', $options = [])
	{
		$options['model'] = $model;
		$options['attribute'] = $attribute;

		return TinyMce::widget($options);
	}
}
