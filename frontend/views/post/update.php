<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ForumPost */

$this->title = 'Update Forum Post: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Topic', 'url' => ['forum/posts', 'id_topic'=>$model->id_topic]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forum-post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_answer', [
        'model' => $model,
    ]) ?>

</div>
