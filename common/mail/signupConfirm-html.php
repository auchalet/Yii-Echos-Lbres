<?php
use yii\helpers\Html;
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-signup', 'auth_key' => $auth_key]);


?>

<h1>Merci pour ton inscription</h1>

<h2>Echos-Libres te remercie de faire partie des siens.</h2>

<p>Encore une petite étape avant de te lancer dans l'aventure, clique sur ce lien pour confirmer ton inscription :</p>

<p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>


