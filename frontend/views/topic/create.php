<?php

use yii\helpers\Html;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model frontend\models\ForumTopic */

$this->title = 'Create Forum Topic';
$this->params['breadcrumbs'][] = ['label' => 'Forum Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-topic-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    	'id_user'=> Yii::$app->user->id,
    ]) ?>

</div>
