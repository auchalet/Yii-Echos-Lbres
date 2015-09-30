<?php 
	use yii\widgets\Pjax;
	use yii\helpers\Html;
?>
<?php Pjax::begin(['enablePushState' => false]); ?>
	ID : <?= $id ?>
	Votes : <?= $score ?>
	<?= Html::a('+', ['/post/voteup','id'=>$id]) ?>
	<?= Html::a('-', ['/post/votedown','id'=>$id]) ?>
<?php Pjax::end(); ?>