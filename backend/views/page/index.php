<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Site Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'h1:ntext',
            'h2:ntext',
            'content:ntext',
            // 'slug',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'meta_description:ntext',
            // 'meta_keywords:ntext',
            // 'category_id',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
