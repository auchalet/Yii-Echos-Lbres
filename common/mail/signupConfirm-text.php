<?php

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-signup', 'auth_key' => $auth_key]);


?>


Merci pour ton inscription

Echos-Libres te remercie de faire partie des siens.

Encore une petite étape avant de te lancer dans l'aventure, clique sur ce lien pour confirmer ton inscription : <?= $confirmLink ?>


