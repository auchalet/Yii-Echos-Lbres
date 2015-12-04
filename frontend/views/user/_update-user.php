<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
$this->title = 'Modification des identifiants';
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('account')->pseudo.' - Profil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpdateLogsForm */
/* @var $form ActiveForm */
?>
<div class="user-update-logs">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['value' => $user->username])->label('Login') ?>
        <?= $form->field($model, 'email')->textInput(['value' => $user->email])->label('E-mail') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Nouveau mot de passe') ?>
        <?= $form->field($model, 'password_repeat')->passwordInput()->label('Confirmer mot de passe') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-update-logs -->
test