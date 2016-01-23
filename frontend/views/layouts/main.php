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
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top headroom',
        ],
    ]);

    ?>

    <a class="brand fa fa-globe fa-6" href="index.php?r=site/index"></a>

    <?php

    $menuItems = [
        ['label' => '', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'home fa fa-home fa-6']],
        [
            'label' => 'Ensemble(s)',
            'items' => [
                ['label' => 'Idées', 'url' => ['/site/index']],
                ['label' => 'Echos-Libres', 'url' => ['/site/index']],
                ['label' => 'Fondateurs', 'url' => ['/site/index']],
                ['label' => 'Aspirations', 'url' => ['/site/index']],
                ['label' => 'Motivations', 'url' => ['/site/index']],
            ]

        ]
    ];
    /*
    $menuItems[] = 
        [
            'label' => 'Nos Echos',
            'items' => [
                ['label' => 'Nouvelles', 'url' => ['/site/index']],
                ['label' => 'Découvertes', 'url' => ['/site/index']],
                ['label' => 'Participe', 'url' => ['/site/index']],
            ]

        ];

    */

    $menuItems[] =  
        [
            'label' => 'Forum',
            'items' => [
                ['label' => 'Liste des membres', 'url' => ['/site/index']],
                ['label' => 'Charte du forum', 'url' => ['/site/index']],
                ['label' => 'Charte de modération', 'url' => ['/site/index']],
            ]

        ];
    $menuItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
                   
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '', 'url' => ['/site/signup'], 'linkOptions' => ['title' => 'Connexion | Inscription','class' => 'login fa fa-sign-in']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->user->identity->username,
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

    <footer id="footer" class="top-space">

        <div class="footer1">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3 widget">
                        <h3 class="widget-title">Contact</h3>
                        <div class="widget-body">
                            <p>1818181818<br>
                                <a href="mailto:#">echos-libres@protonmail.com</a><br>
                                <br>
                                18, rue de la ruelle 18 180 MINECRAFT
                            </p>    
                        </div>
                    </div>


                    <a class='fa fa-globe fa-4'></a>
                    <i class='fa fa-globe fa-4'></i>

                    <div class="col-md-3 widget">
                        <h3 class="widget-title">Follow me</h3>
                        <div class="widget-body">
                            <p class="follow-me-icons">
                                <a href=""><i class="fa fa-twitter fa-2"></i></a>
                                <a href=""><i class="fa fa-dribbble fa-2"></i></a>
                                <a href=""><i class="fa fa-github fa-2"></i></a>
                                <a href=""><i class="fa fa-facebook fa-2"></i></a>
                            </p>    
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <h3 class="widget-title">Text widget</h3>
                        <div class="widget-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad id expedita cupiditate repellendus possimus unde?</p>
                            <p>Eius consequatur nihil quibusdam! Laborum, rerum, quis, inventore ipsa autem repellat provident assumenda labore soluta minima alias temporibus facere distinctio quas adipisci nam sunt explicabo officia tenetur at ea quos doloribus dolorum voluptate reprehenderit architecto sint libero illo et hic.</p>
                        </div>
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>

        <div class="footer2">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="simplenav">
                                <a href="#">Home</a> | 
                                <a href="about.html">About</a> |
                                <a href="sidebar-right.html">Sidebar</a> |
                                <a href="contact.html">Contact</a> |
                                <b><a href="signup.html">Sign up</a></b>
                            </p>
                        </div>
                    </div>

                        <div class="widget-body">
                            <p class="text-right">
                                Copyright &copy; 2014, Your name. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a> 
                            </p>
                        </div>
                    </div>

                </div> <!-- /row of widgets -->
            </div>
        </div>
    </footer>   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
