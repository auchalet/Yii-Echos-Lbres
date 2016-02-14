<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catégories de pages';
$this->params['breadcrumbs'][] = ['label' => 'Accueil', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Catégories de pages'];

?>
<div class="site-page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            if(Yii::$app->user->can('admin')) {
                echo Html::a('Créer une catégorie', ['create-category'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>

    <?= 
        'Pages'
        /*GridView::widget([
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
    ]);*/ ?>

</div>
