<?php 
	use yii\widgets\Pjax;
	use yii\helpers\Html;
?>
<?= $id ?> et <?= $score ?>
<?php Pjax::begin(); ?>
	Votes : <?= $score ?>
	<?= Html::a('+', ['/post/voteup','id'=>$id, 'score'=>$score]) ?>
	<?= Html::a('-', ['/post/votedown','id'=>$id, 'score'=>$score]) ?>
<?php Pjax::end(); ?>