<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumTopic */

$this->title = 'Update Forum Topic: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Forum Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forum-topic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
