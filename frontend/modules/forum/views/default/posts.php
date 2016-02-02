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
$id_topic=$this->context->actionParams['id_topic'];

?>
<h1>Topic : <?= $topic[0]['title'] ?></h1>


<div class="tab-content">
    
    <?php foreach ($posts as $attr => $val): ?>
    	
        <div class="tab-content">
        	<strong><?= $val['id'] ?></strong>
                <i>Créé le : <?= Html::encode($val['createdAt']) ?> par </i><strong><a href="<?= Url::to(['/user/index', 'username' => $author[$attr]['username']]) ?>"><?= $author[$attr]['username'] ?></a></strong><br>

            <i>Modifié le : <?= Html::encode($val['updatedAt']) ?></i>
            			
            <!-- Score en AJAX -->
            
            <label class="badge">Votes : <span id="score_<?= $val['id'] ?>"><?= $val['score'] ?></span></label>
            
            <?php if(Yii::$app->user->can('vote')): ?>
            <div class="btn-group">
                <span class="btn btn-default" onclick="vote('plus_<?= $val['id'] ?>');">+</span>                     
                <span class="btn btn-default" onclick="vote('moins_<?= $val['id'] ?>');">-</span>                     
            </div>
            <?php endif; ?>
           
			
            
            <?php if($val['id_user']==Yii::$app->user->id): ?>
            <a class="btn btn-primary" href="<?= Url::to(['/post/update', 'id'=>$val['id']]) ?>">Modifier</a>
            <?php endif; ?>

        </div>

        <div class="container">
            <?= Html::encode($val['content']) ?>
        </div>
        <br>
        <br>

    
    <?php endforeach; ?>
    <?php if(!Yii::$app->user->isGuest): ?>

        <a class="btn btn-primary" href="<?= Url::to(['/post/answer', 'id_topic'=>$id_topic]) ?>">Répondre au topic</a>
        <a class="btn btn-primary" href="<?= Url::to(['topics','id_category'=>$topic[0]['id_category']]) ?>">'Retour aux topics</a>

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
            $.post('index.php?r=post/voteup',{

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
            $.post('index.php?r=post/votedown',{

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
