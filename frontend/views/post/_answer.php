<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumPost */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="forum-post-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_user')->textInput(['value'=>Yii::$app->user->id, 'disabled'=>'true']) ?>

    <?= $form->field($model, 'id_topic')->textInput(['value'=>$id_topic]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
