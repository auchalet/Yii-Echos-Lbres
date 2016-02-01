<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div style="display: block;" class="popup update-user-popup">

    <h1>Modification de l'utilisateur : <?= $user->username ?></h1>


    <div class="modal-footer">
        <a id="update-user-validate" href="#" class="btn btn-primary">Valider</a> 
        <a id="update-user-cancel" href="#" class="btn btn-primary">Retour</a>    
    </div>
</div>