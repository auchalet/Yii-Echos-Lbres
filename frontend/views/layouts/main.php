<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;


if (!Yii::$app->user->isGuest ) {
    if(Yii::$app->session->get('account') == null){
        Yii::$app->session->set('account', Yii::$app->user->identity->findAccount()); 
    }
    if(Yii::$app->session->get('member') == null && Yii::$app->user->identity->findAccount()!=NULL){
        Yii::$app->session->set('member', Yii::$app->user->identity->findAccount()); 
    }
}



AppAsset::register($this);
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


    <?php
    NavBar::begin([
        'brandLabel' => 'Echos-Libres',

        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top headroom',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => 'Forum', 'url' => ['/forum/default/index']]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->session->get('account')->pseudo,
            'items' => [ 
                ['label' => 'Déconnexion', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ['label' => 'Profil', 'url' => ['/user/index']]
            ]

        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav pull-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-full">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Echos-Libres <?= date('Y') ?></p>


        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
