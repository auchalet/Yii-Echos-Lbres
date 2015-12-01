<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ForumCategory */

$this->title = 'Create Forum Category';
$this->params['breadcrumbs'][] = ['label' => 'Forum Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'themes' => $themes
    ]) ?>

</div>
