<?php
/* @var $this yii\web\View */
var_dump($user);
$data = Yii::$app->getSecurity()->decryptByPassword($user->__get('password_hash'), $user->__get('auth_key'));
?>
<h1>Profil : <?= $user->__get('username') ?></h1>

<div id="userAttributes" class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <td>Login</td>
                <td><?= $user->username ?></td>
                <td><a href="#">Modifier login</a></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?= $user->password ?></td>
                <td><a href="#">Modifier password</a></td>                
            </tr>
        </tbody>
    </table>
</div>
