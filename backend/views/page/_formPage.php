<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use yii\jui;
/* @var $this yii\web\View */
/* @var $model common\models\SitePage */
/* @var $form yii\widgets\ActiveForm */
?>
<pre>Faire des blocs qu'on peut cacher en JS // En bas, bloc SEO affiché pour le membre SEO (metas/slug)</pre>
<div class="site-page-form">

    <?php $form = ActiveForm::begin(['id' => 'page-form']); ?>
    <div id="bloc-title" class='bloc-cms'>
        <i class="fa fa-arrow-up"></i>
        <p>Nom de la page (= Nom de l'onglet)</p>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Titre de la page') ?>
    </div>
    <div id="bloc-titres" class='bloc-cms'>
        <i class="fa fa-arrow-up"></i>
        <p>Titres</p>
        
        <?= $form->field($model, 'h1')->input('text')->label('Titre principal') ?>

        <?= $form->field($model, 'h2')->input('text')->label('Sous-titre') ?>
    </div> 


    <div id="bloc-content" class='bloc-cms'>
        <i class="fa fa-arrow-down"></i>
        <p>Contenu</p>
        <?= $form->field($model, 'content')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'fr_FR',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap preview anchor",
            "searchreplace visualblocks code",
            "media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]) ?>
    </div>

    <div id="bloc-seo" class='bloc-cms'>
        <i class="fa fa-arrow-down"></i>
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

<?php 

    $this->registerJs(
            "$(document).ready(function(e){"
            . "e.preventDefault;"
            . "$('.fa-arrow-down').click(function(){"
            . "console.log('ouvrir');"
            . "$(this).nextAll('.form-group').css('display','block');"
            . "$(this).switchClass('fa-arrow-down', 'fa-arrow-up', 'slow');"
            . "});"
            
            . "$('.fa-arrow-up').click(function(){"
            . "var a = $(this);"
            . "a.nextAll('.form-group').css('display','none');"
            . "$(this).switchClass('fa-arrow-up', 'fa-arrow-down', 'slow');"

            . "});"
            . "});"
            );

?>