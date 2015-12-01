<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ForumPost */

$this->title = 'Create Forum Post';
$this->params['breadcrumbs'][] = ['label' => 'Forum Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
