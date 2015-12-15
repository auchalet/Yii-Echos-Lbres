<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Account */
/* @var $form ActiveForm */


?>
<div class="user-_update-account">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'pseudo')->textInput(['value' => $account->pseudo]) ?>
        
        <!-- Voir pour champ Age virtuel // Style Steam ? // Champ text ? // DropDown ? // DatePicker ? -->
        <?= $form->field($model, 'age')->textInput(['value' => $account->age]) ?>
        <?= $form->field($model, 'favorite_category') ?>
        <?= $form->field($model, 'newsletter') ?>
        <?= $form->field($model, 'past') ?>
        <?= $form->field($model, 'present') ?>
        <?= $form->field($model, 'future') ?>
        <?= $form->field($model, 'why_register') ?>
        <?= $form->field($model, 'skills') ?>
        <?= $form->field($model, 'interests') ?>
        <?= $form->field($model, 'other') ?>
        <?= $form->field($model, 'sex') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-_update-account -->
