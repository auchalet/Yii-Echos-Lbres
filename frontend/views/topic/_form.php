<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumTopic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-topic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['value'=> 0]) ?>

    <?= $form->field($model, 'id_user')->textInput(['value'=> $id_user]) ?>

    <?= $form->field($model, 'id_category')->textInput(['value'=>$id_category]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
