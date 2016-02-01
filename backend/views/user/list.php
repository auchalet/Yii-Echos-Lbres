<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;


?>


<div class="panel panel-default">
    
  <div class="panel-heading"><h1>Liste des utilisateurs</h1></div>
  <div class="panel-body">
    <p>
        Liste des utilisateurs enregistrés sur le site / Les membres de l'asso et les admins peuvent ajouter un nouvel utilisateur, les modifier et les rendre inactifs
        <br>
        Lors de la création d'un utilisateur, créer un Account et un User.
    </p>
  </div>

<table id="user-table" class="table">
    <thead>
        <tr>
            <th><span class="glyphicon glyphicon-user"></span></th>
            <th>Pseudo</th>
            <th>E-mail</th>
            <th>Statut</th>            
            <th>Action</th>            
        </tr>
    </thead>
    <tbody>
        
        <?php foreach($users as $k => $v): ?>
        <tr>
            <td><?= $k+1 ?></td>
            <td><?= $v->username ?></td>
            <td><?= $v->email ?></td>
            <td><?= $v->status ?></td>
            <td>
                <ul class="nav nav-tabs">
                    <!--<li><a href="<?= Url::to('profile', ['id_user' => $v->id]); ?>" class="glyphicon glyphicon-eye-open"></a></li>-->
                    
                    <!-- Lien vers profil en frontend // Non optimisé car ne marche pas si rewrite URL // Voir avec createUrl() -->
                    
                    <li><a href="<?= Yii::$app->urlManagerFrontEnd->baseUrl.'user/index&id_user='.$v->id ?>" class="glyphicon glyphicon-eye-open" target="_blank"></a></li>                                                       
                    <li><a href="<?= Url::to(['user/update', 'id_user'=>$v->id]) ?>"  class="glyphicon glyphicon-pencil" id="update-user"></a></li>
                    
                    <!-- Popup en JS pour modifier l'user -->
                    <?php

                        Modal::begin([
                            'id' => 'modal-user',

                        ]);

                        echo '<div id="user-popup"></div>';

                        Modal::end();

                    ?>                       
                    
                    <li><a href="<?= Url::to(['user/disable', 'id_user'=>$v->id]) ?>"  class="glyphicon glyphicon-off"></a></li>
                </ul>
            </td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>