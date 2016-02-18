<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Json;
use yii\i18n\Formatter;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $category->title.' - Liste des pages';
$this->params['breadcrumbs'][] = ['label' => 'Accueil', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Catégories de pages'];

//$json_pages = Json::encode($pages);
var_dump($tags);
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
            <tr>
                <?php foreach($pages as $k => $v): ?>
                <th class="list-page-item">
                    Titre :                     
                    <a href="<?= Url::to(['page/view-page', 'id' => $v['id']]) ?>"><?= $v['title'] ?></a>
                    <br>
                    Tags : 
                </th>                               
                <th class="list-page-item">
                    Crée par : <?= $users[$k]['username'] ?>
                    <br>
                    Date : <?= date('d-m-Y H:i:s',  strtotime($v['created_at'])) ?>
                </th>                               
                <th class="list-page-item">
                    Statut : 
                    <?php foreach($status_pages[$k] as $val): ?>
                        <input type="checkbox" class="statut_<?= $val ?>" <?= ($val === '1')?'checked':'' ?>>
                    <?php endforeach; ?>
                </th>                               
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>



