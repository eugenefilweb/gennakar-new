<?php

use app\helpers\App;
use app\helpers\Html;

$this->registerCss(<<< CSS
	#printable {
		max-width: 1024px;
	}
	#printable table {
		width: 100%;
	}
	#printable .vertical-align-top {
		vertical-align: top;
	}
	#printable .border-right-hidden {
		border-right: hidden;
	}
	#printable .border-left-hidden {
		border-left: hidden;
	}
	#printable .border-top-hidden {
		border-top: hidden !important;
	}
	#printable .border-bottom-hidden {
		border-bottom: hidden;
	}
	#printable .border-hidden {
		border: hidden;
	}
	#printable label {
		pointer-events: none;
		margin-bottom: 0;
	}
	#printable .line-height-1rem {
	    line-height: 1rem;
	}
	#printable .font-size-1_1rem {
		font-size: 1.1rem
	}
	#printable .bg-gray {
		background-color: #969696;
	}
	#printable .bg-light-gray {
		background-color: #eaeaea;
	}
	#printable .line-height-1-2rem {
	    line-height: 1rem;
	}
	#printable .row-height,
	#printable .signature {
		min-height: 31px !important;
		height: 31px !important;
	}

	#printable .signature-bottom {
		min-height: 66px !important;
		height: 66px !important;
	}
	#printable .h-64px {
		height: 74px;
	}


	#printable .line-height-md {
	    line-height: 1.1155 !important;
	}

	#printable .mb-n12 {
		margin-bottom: -12px !important;
	}
	#printable .mb-n20 {
		margin-bottom: -20px !important;
	}
	#printable input[type="checkbox"]:checked {
		accent-color: #969696;
	}
	#printable input[type="checkbox"] {
		pointer-events: none;
	}

	#printable td {
		overflow-wrap: anywhere;
	}
	#printable .nowrap {
		white-space: nowrap;
	}
	#printable .text-underline {
		text-decoration: underline;
	}
CSS);

$this->params['withHeader'] = false;
?>

<div id="printable" style="<?= $style ?? '' ?>">

	<?php echo $this->render('printable/page1', ['model' => $model]) ?>

	<div class="page-break"></div>
	<?php echo $this->render('printable/page2', ['model' => $model]) ?>

	<div class="page-break"></div>
	<?php echo $this->render('printable/page3', ['model' => $model]) ?>

	<div class="page-break"></div>
	<?php echo $this->render('printable/page4', ['model' => $model]) ?>
</div>