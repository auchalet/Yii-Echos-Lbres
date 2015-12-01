<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumCategory */
/* @var $form yii\widgets\ActiveForm */
$items=ArrayHelper::map($themes, 'id', 'title');

?>

<div class="forum-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>
    
    <?= $form->field($model, 'id_category')->dropDownList($items,['prompt'=>'Themes'])->label('Thème (Laisser nul pour une nouvelle catégorie)') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
