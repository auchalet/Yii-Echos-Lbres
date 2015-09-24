<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ForumCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forum Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Forum Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'status',
            'id_user',
            // 'createdAt',
            // 'updatedAt',
            // 'meta_title:ntext',
            // 'meta_description:ntext',
            // 'meta_keyword:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
