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
<h1>Topic : <?= $topic[0]['title'] ?></h1>


<div class="tab-content">
    
    <?php foreach ($posts as $attr => $val): ?>
    
        <div class="tab-content">
            <i>Créé le : <?= Html::encode($val['createdAt']) ?> par </i><strong><?= $author[$attr]['username'] ?></strong><br>
            <i>Modifié le : <?= Html::encode($val['updatedAt']) ?></i>
            
			<?= $this->render('/post/vote', ['score'=>$val['score'], 'id'=>$val['id']]) ?>
            
            <?php if($val['id_user']==Yii::$app->user->id): ?>
                <?= Html::a('Modifier', ['/post/update','id'=>$val['id']], ['class'=>'btn btn-primary']) ?>
            <?php endif; ?>

        </div>

        <div class="container">
            <?= Html::encode($val['content']) ?>
        </div>
        <br>
        <br>

    
    <?php endforeach; ?>
    <?php if(!Yii::$app->user->isGuest): ?>
        <br>
        <br>
    <?= Html::a('Répondre au topic', ['/post/answer','id_topic'=>$val['id_topic']], ['class'=>'btn btn-primary']) ?>

    <?php endif; ?>    
    
</div>
