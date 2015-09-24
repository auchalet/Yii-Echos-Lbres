<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* Vue de la fonction actionIndex()
/* @var $this yii\web\View */
/* @var $searchModel frontends\ForumPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forum - Index';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Index du forum</h1>

<h2>Categories</h2>

<div class="tab-content">
    
    <?php 
        
    foreach ($categories as $k => $v): ?>
    
    
    <a href='<?= Url::to(['forum/topics', 'id_category'=>$v['id'] ]); ?>'><?= Html::encode($v['title']) ?></a>
    <br>
    <?= Html::encode($v['description']) ?>
    <br><br><br>

    <?php endforeach; ?>

</div>
