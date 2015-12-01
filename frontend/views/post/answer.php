<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ForumPost */

$this->title = 'Votre réponse au topic';
$this->params['breadcrumbs'][] = ['label' => 'Topic', 'url' => ['forum/posts', 'id_topic'=>$id_topic]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_answer', [
        'model' => $model,
        'id_topic' => $id_topic
    ]) ?>

</div>
