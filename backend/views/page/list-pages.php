<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Json;
use yii\i18n\Formatter;
use yii\helpers\Url;
use yii\rbac\DbManager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $category->title.' - Liste des pages';
$this->params['breadcrumbs'][] = ['label' => 'Accueil', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Catégories de pages'];

//$json_pages = Json::encode($pages);
?>
<div class="site-page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            if(Yii::$app->user->can('membre')) {
                echo Html::a('Créer une nouvelle page', ['create-page', 'id_category' => $category->id], ['class' => 'btn btn-success']);
            }
        ?>
    </p>

    <pre>Nombre de pages = <?= count($pages) ?></pre>
    
    <table id="table-pages" class="table-bordered table-responsive">
        <tbody>
            
            <?php foreach($pages as $k => $v): ?>
            <tr>
                <th class="list-page-item">
                        Titre :                     
                        <a href="<?= Url::to(['page/view-page', 'id' => $v['id']]) ?>"><?= $v['title'] ?></a>
                        <br>
                        Tags : 
                        <?php foreach ($tags[$k] as $val): ?>
                            <a href="<?= Url::to(['/tag/index']) ?>">#<?= $val->title ?></a>
                        <?php endforeach; ?>
                    </th>                               
                <th class="list-page-item">
                    Crée par : <?= $users[$k]['username'] ?>
                    <br>
                    Date : <?= date('d-m-Y H:i:s',  strtotime($v['created_at'])) ?>
                </th>                               
                <th class="list-page-item">
                    Statut : 
                    <!-- TODO : Faire l'affichage du statut en fonction du membre --> 
                    <?php for($i=0;$i<$v['status'];$i++): ?>
                        <input type="checkbox" class="statut_1" checked>
                    <?php endfor; ?>
                    <?php if(Yii::$app->authManager->checkAccess($users[$k]['id'],'membre')): ?>
                        <?php for($j=$i;$j<3;$j++): ?>
                            <input type="checkbox" class="statut_0">
                        <?php endfor; ?>
                        
                    <?php endif; ?>
                </th>       
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



