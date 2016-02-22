<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SitePage */
/* @var $form yii\widgets\ActiveForm */
?>
<pre>Faire des blocs qu'on peut cacher en JS // En bas, bloc SEO affiché pour le membre SEO (metas/slug)</pre>
<div class="site-page-form">

    <?php $form = ActiveForm::begin(); ?>
    <div>
        <p>Titre de la page</p>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div>
        <p>Titres</p>
        
        <?= $form->field($model, 'h1')->textarea(['rows' => 6])->label('Titre principal') ?>

        <?= $form->field($model, 'h2')->textarea(['rows' => 6])->label('Sous-titre') ?>
    </div>


    <div>
        <p>Contenu</p>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    </div>

    <div>
        <p>Options SEO</p>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label('URL') ?>
        <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>
    </div>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>



    <?= $form->field($model, 'category_id')->textInput(['value' => '6']) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
