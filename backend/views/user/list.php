<?php
/* @var $this yii\web\View */


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
            <th>Login</th>
            <th>E-mail</th>
            <th>Statut</th>            
            <th>Action</th>            
        </tr>
    </thead>
    <tbody>
        
        <?php foreach($users as $k => $v): ?>
        <tr>
            <td><?= $k+1 ?></td>
            <td><?= $account[$k]['pseudo'] ?></td>
            <td><?= $v->username ?></td>
            <td><?= $v->email ?></td>
            <td><?= $v->status ?></td>
            <td>
                <ul class="nav nav-tabs">
                    <li><a href="index.php?r=user/profile" class="glyphicon glyphicon-eye-open"></a></li>
                    <li><a href="index.php?r=user/update"  class="glyphicon glyphicon-pencil"></a></li>
                    <li><a href="index.php?r=user/disable"  class="glyphicon glyphicon-off"></a></li>
                </ul>
            </td>
            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>