<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Button;

/* Vue de la fonction actionPosts()
/* @var $this yii\web\View */
/* @var $searchModel frontends\ForumPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorie';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Catégorie</h1>

<h2>Posts associés</h2>

<div class="tab-content">
    
    <?php foreach ($posts as $attr => $val): ?>
    
        <h1><?= Html::encode($val['title']) ?></h1>
        <br>
        <i>Créé le : <?= Html::encode($val['createdAt']) ?></i>
        <br>
        <i>Modifié le : <?= Html::encode($val['updatedAt']) ?></i>
        <br>
        <div class="container">
            <?= Html::encode($val['content']) ?>
        </div>
        
        <?= Html::a('Répondre', ['/forum/answer','id_topic'=>$val['id']], ['class'=>'btn btn-primary']) ?>

    
    <?php endforeach; ?>
        
    
</div>
