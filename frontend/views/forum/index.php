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

<?php if(!Yii::$app->user->isGuest): ?>

<a class="btn-primary btn" href="<?= Url::to(['/category/create']); ?>">Créer une nouvelle catégorie</a>

<?php endif; ?>

<div class="tab-content">
    
    <!-- Affichage du nom de la thématique -->
    <?php foreach($themes as $k=>$val): ?>  
    
    <h3><?= $val['title'] ?></h3>
    
    <!-- Pour chaque thème, affichage des catégories correspondantes -->
    <?php foreach ($categories as $k => $v): ?>
    
    <?php if($v['id_category']==$val['id']): ?>
    
    <a href='<?= Url::to(['forum/topics', 'id_category'=>$v['id'] ]); ?>'><?= Html::encode($v['title']) ?></a>
    <br>
    <?= Html::encode($v['description']) ?>
    <br><br><br>
    
    <?php endif;
    endforeach;
    endforeach; ?>

</div>
