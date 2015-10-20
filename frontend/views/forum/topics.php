<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* Vue de la fonction actionTopics()
/* @var $this yii\web\View */
/* @var $searchModel frontends\ForumPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorie';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Catégorie</h1>

<h2>Topics associés</h2>

<p class="text-ri"><a href="<?= Url::to(['/topic/new', 'id_category'=>$id_category]) ?>">Créer un nouveau sujet</a></p>


<div class="tab-content">
    
    <?php foreach ($topics as $attr => $val): ?>
    
        <a href='<?= Url::to(['forum/posts', 'id_topic'=>$val['id']]); ?>'><?= Html::encode($val['title']) ?></a>
        <br>
        <i>Cree le : <?= Html::encode($val['createdAt']) ?></i>
        <br>
        <i>Modifie le : <?= Html::encode($val['updatedAt']) ?></i>

    	<br>
    	<br>
    <?php endforeach; ?>
        
    
</div>
