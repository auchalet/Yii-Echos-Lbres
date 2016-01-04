<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\UploadForm */
/* @var $form ActiveForm */

if($avatar) {
    $pathAvatar = '/uploads/'.sha1($user->username).'/'.$avatar->filename;
}

$pathBaseAvatar = '/uploads/'.sha1('base').'/avatar.jpg';


$gravatar_path = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($user->email))).'?d=identicon&s=60&r=G';

?>
<!-- tools-upload -->

<div style="display: block;" class="popup profile-picture-popup">
    <h2>Change ton avatar</h2>
        <hr>
        <a class="avatar-change" id="avatar-default">
            <?= Html::img($pathBaseAvatar, ['label'=>'Image', 'format'=>'raw']) ?>
            <span class="avatar-description">Avatar par défaut</span>
            <span class="badge-earned-check"></span>
        </a>    
        <hr>
        <a class="avatar-change" id="avatar-perso">
            <?= Html::img($pathAvatar, ['label'=>'Image', 'format'=>'raw']) ?>
            <span class="avatar-description">Avatar du site</span>
            <span class="badge-earned-check"></span>
        </a>
        <hr>
        <a class="avatar-change" id="gravatar">
            <?= Html::img($gravatar_path, ['label'=>'Image', 'format'=>'raw']) ?>            
            <span class="avatar-description">Gravatar</span>
            <span class="badge-earned-check"></span>
        </a>
        <hr>
        <div class="tools-upload">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'imageFile')->fileInput() ?>

                <?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'id' => 'avatar-upload']) ?>
                <?php ActiveForm::end(); ?>
        </div>                


    <a id="profile-picture-cancel" href="#">cancel</a>
</div>
<?php
    $this->registerJs("
    //Changement de l'avatar actif
    $('.avatar-change').click(function() {
        var t = $(this).attr('id');
        alert(t);
        $.ajax({
            url : 'index.php?r=user/switch-avatar',
            method: 'POST',
            data : { t: t }
        })
        .done(function(){
            console.log('switch ok');
            
        })
        .fail(function(){
            console.log('AJAX fail');
        });
        
    });
    ",\yii\web\View::POS_READY); 
?>