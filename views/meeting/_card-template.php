<?= $this->render('_card-filter', [
   'searchModel' => $searchModel,
]) ?>

<?= $this->render('_card-listview', [
   'dataProvider' => $dataProvider,
   'attribute' => $attribute,
]) ?>