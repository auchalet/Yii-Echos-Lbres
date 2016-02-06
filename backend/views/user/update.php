<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;



?>

<div style="display: block;" class="popup update-user-popup">

    <h1>Modification de l'utilisateur : <?= $user->username ?></h1>

    <?php $form = ActiveForm::begin(); ?>

       
        <!-- Voir pour champ Age virtuel // Style Steam ? // Champ text ? // DropDown ? // DatePicker ? -->
        <?= $form->field($user, 'username')->textInput(['value' => $user->username]) ?>
        <?= $form->field($user, 'email')->textInput(['value' => $user->email]) ?>
        <?= $form->field($user, 'status')->dropDownList([10 => 'En ligne', 0 => 'Hors ligne'], ['value' => $user->status]) ?>
        
    <?php if(isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id)['admin'])): ?>
        <?= $form->field($user, 'superadmin')->dropDownList([0 => 'Non', 1=> 'Oui'], ['value' => $user->superadmin]) ?>         
    <?php endif; ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>