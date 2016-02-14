<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SitePage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Site Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'h1:ntext',
            'h2:ntext',
            'content:ntext',
            'slug',
            'status',
            'created_at',
            'updated_at',
            'meta_description:ntext',
            'meta_keywords:ntext',
            'category_id',
            'user_id',
        ],
    ]) ?>

</div>
