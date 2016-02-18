<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\SiteCategory;

AppAsset::register($this);
$item_categ = array();
$page_categories = SiteCategory::getAll();
foreach ($page_categories as $k=>$v){
    array_push($item_categ, ['label' => $v['title'], 'url' => ["page/list-pages", 'id_category' => $v['id']]]);
}

//var_dump($item_categ); die;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Echos-Libres',

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
  
        
        if(Yii::$app->user->can('manageRbac')) {
            $menuItems[] = ['label' => 'Admin', 'url' => ['/rbac']];
        }
        
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' =>' post']
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    
    
    <div class="container-fluid" id="page-body">
        <div class="row">
            <div class="col-md-2 col-sm-3 sidebar">
                <i class="fa fa-arrow-left fa-6 open-sidebar" style="color:white;"></i>               
                <?php

                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                } else {
                    $menuItems = [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'Utilisateurs', 'url' => ['/user/index']],
                        ['label' => 'Forum', 'url' => ['/forum/index']]
                    ];
                    
                    $menuItems[]= [
                        'label' => 'Pages du site', 
                        'url' => ['/page/categories'], 
                        'items' => $item_categ                       
                    ];
                    
                    $menuItems[] = ['label' => 'Evenements', 'url' => ['/event/index']];   
                    $menuItems[] = ['label' => 'Projets de la communauté', 'url' => ['/project/index']];   
                    $menuItems[] = ['label' => 'Tchat', 'url' => ['/tchat/index']];   

                    

                    $menuItems[] = [
                        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ];
                }

                echo Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>
            <div class="content col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>


    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
