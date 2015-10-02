<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Button;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;




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
        	<strong><?= $val['id'] ?></strong>
            <i>Créé le : <?= Html::encode($val['createdAt']) ?> par </i><strong><?= $author[$attr]['username'] ?></strong><br>
            <i>Modifié le : <?= Html::encode($val['updatedAt']) ?></i>
            			
			<!-- Score en AJAX -->
			
			<?php Pjax::begin(['enablePushState' => false]); ?>
				Votes : <?= $val['score'] ?>
				<?= Html::a('+', ['/post/voteup','id'=>$val['id']]) ?>
				<?= Html::a('-', ['/post/votedown','id'=>$val['id']]) ?>
			<?php Pjax::end(); ?>
			
            
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

    <?= Html::a('Répondre au topic', ['/post/answer','id_topic'=>$val['id_topic']], ['class'=>'btn btn-primary']) ?>
    <?= Html::a('Retour aux topics', ['topics','id_category'=>$topic[0]['id_category']], ['class'=>'btn btn-primary']) ?>

    <?php endif; ?>
    

    
</div>
<div class="tab-content">
    <?php 
    echo LinkPager::widget([
    	'pagination' => $pages,
	]);    
    ?>
</div>

