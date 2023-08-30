<?php

use app\helpers\Html;

// $encode = json_encode($data);
// $encodeData = json_encode($formattedData);

// $this->registerJs(<<< JS
// 	console.log('data', {$encode})
// 	console.log('formattedData', {$encodeData})
// JS);

$this->registerCss(<<< CSS
	.tweeter-hashtag-container {
		background: #fff;
	    padding: 1rem;
	    border-radius: 10px;
	    border: 1px solid #ddd;
	    cursor: pointer;
	    height: {$height};
	}
	.tweeter-hashtag-container .tweeter-list {
	    overflow: auto;
	    height: 620px;
	}
	.tweeter-hashtag-container .profile_image_url {
		width: 48px;
		height: 48px;
		border-radius: 50px;
	}
	.tweeter-hashtag-container .twitter-name {
	    font-weight: 600;
	    font-size: 1.1rem;
	    color: #000;
	}
	.tweeter-hashtag-container .twitter-name:hover {
	    color: #000;
		text-decoration: underline !important;
	}
	.tweeter-hashtag-container .twitter-username {
		color: #536471;
		margin-left: 0.5rem;
	}
	.tweeter-hashtag-container .twitter-name-username {
		margin-bottom: 0.5rem;
	}
	.tweeter-hashtag-container .hashtag-title {
		color: #000;
		font-size: 1.5rem !important;
	}
	.tweeter-hashtag-container .hashtag-title-container {
		background-color: #fff;
	}
CSS);

$this->registerJs(<<< JS
	$('.tweeter-hashtag-container .tweet-item').click(function(e) {
		let link = $(this).data('link');

		if (! e.target.hasAttribute('href')) {
			let a = document.createElement('a');
			a.target= '_blank';
			a.href= link;
			a.click();
		}
	});
JS);
?>
<?php if ($formattedData): ?>
	<div class="tweeter-hashtag-container">
		<div class="hashtag-title-container">
			<p class="lead font-weight-bolder hashtag-title">
				<?= $query ?>
			</p>
			<hr>
		</div>
		<div class="tweeter-list">
			<?php foreach ($formattedData as $fd): ?>
				<div class="d-flex tweet-item" data-link="<?= $fd['link'] ?>">
					<?= Html::img($fd['author']['profile_image_url'], [
						'class' => 'img-fluid profile_image_url',
					]) ?>
					<div class="ml-5">
						<p class="twitter-name-username">
							<?= Html::a($fd['author']['name'], $fd['author']['url'] ?? '#', [
								'class' => 'twitter-name',
								'target' => '_blank'
							]) ?>
							<?= Html::a('@'.$fd['author']['username'], $fd['author']['url'] ?? '#', [
								'class' => 'twitter-username',
								'target' => '_blank'
							]) ?>
						</p>

						<?= $fd['text'] ?>

						<?php if (($medias = $fd['medias']) != null): ?>
							<?php foreach ($medias as $media): ?>
								<div>
									<?php if ($media['type'] == 'video'): ?>
										<video width="100%" height="240" controls>
											<source src="<?= $media['url'] ?>" type="video/mp4">
											<source src="<?= $media['url'] ?>" type="video/ogg">
										</video>
									<?php else: ?>
										<?= Html::img($media['url'], ['class' => 'img-fluid']) ?>
									<?php endif ?>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
					<hr>
				</div>
				<hr>
			<?php endforeach ?>
		</div>
	</div>
<?php endif ?>


