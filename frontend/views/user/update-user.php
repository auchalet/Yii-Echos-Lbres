<?php 

use yii\helpers\Html;
var_dump($user->username);
?>

<h1>Modifier identifiants</h1>

<?= $this->render('_update-user', array('model'=>$model , 'user' => $user)); ?>



