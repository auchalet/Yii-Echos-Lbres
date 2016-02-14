<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SitePage */

$this->title = 'Nouvelle catégorie de page';
$this->params['breadcrumbs'][] = ['label' => 'Site Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCategory', [
        'model' => $model,
    ]) ?>

</div>
