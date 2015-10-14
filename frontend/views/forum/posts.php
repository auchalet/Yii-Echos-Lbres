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
            
            <label class="badge">Votes : <span id="score_<?= $val['id'] ?>"><?= $val['score'] ?></span></label>
            
            <div class="btn-group">
                <span class="btn btn-default" onclick="vote('plus_<?= $val['id'] ?>');">+</span>                     
                <span class="btn btn-default" onclick="vote('moins_<?= $val['id'] ?>');">-</span>                     
            </div>


			
            
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
<?php
    $this->registerJs("
        function vote(type_id){
        var tab=type_id.split('_');
        var type=tab[0];
        var id=tab[1];
        var score_html=$('#score_'+id).html();
        var score=parseInt(score_html);
        
        if(type=='plus'){
            console.log(id);
            $.post('/post/voteup',{
                id: id
            })
            .success(function(data){
                $('#score_'+id).html(score+1);        
            })
            .fail(function(){
                console.log('Echec Ajax');
            });
        }
        
        if(type=='moins'){
            console.log('moins');
            $.post('/post/votedown',{
                id: id
            })
            .success(function(data){
                $('#score_'+id).html(score-1);        
            })
            .fail(function(){
                console.log('Echec Ajax');
            });
        }
    }",\yii\web\View::POS_END); 
?>
