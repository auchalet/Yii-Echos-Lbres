<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use common\rbac\OwnRule;

/* @var $this yii\web\View */
$this->title = 'Echos-Libres - Profil de '.$user->username;
$this->params['breadcrumbs'][] = $this->title;



?>

<div id="header-profil">
    <div class="" style="float:left;">
        <h1>Profil : <?= $user->username ?></h1>
        <ul>
            <li>Inscrit sur le site depuis le <?= Yii::$app->formatter->asDate($user->created_at); ?> </li>
            
           
            <?php if($member && $member->paid === 1): ?>
            <li>Membre de l'asso depuis le <?= Yii::$app->formatter->asDate($member->adhesion); ?> </li>
            <?php endif; ?>
            
        </ul>
    </div>
    
    <?php if(Yii::$app->user->getId() === $user->id): ?>
    <div id="userSiteAttributes">
        <ul class="" style="display:inline;">            
            <li>Email : <?= $user->email ?></li>
            <li>Password : ********</li>           
            <li><a href="<?= Url::to(['user/update-logs']) ?>">Modifier</a>
        </ul>
    </div>
    <?php endif; ?>
    
</div>

<div class="core-profil">
    
    <!-- Créer une règle pour que l'admin et l'utilisateur seuls puissent modifier le profil -->
    <?php if(Yii::$app->user->getId() === $user->id): ?>
    <a href="<?= Url::to(['user/update-account']) ?>">Modifier le profil</a>
    <?php endif; ?>
    
    <div id="avatar">

        <?= Html::img($avatar, ['id' => 'img-avatar', 'label'=>'Image', 'format'=>'raw']) ?>
        
        <?php if(Yii::$app->user->can('updateOwnUser', ['user' => $user->id])): ?>
        <button value="<?= Url::to(['user/change-avatar']) ?>" class="btn btn-primary" id="change-avatar">Ajouter un avatar <br> (compatible Gravatar)</a>
        <?php endif; ?>
    </div>
    

    <!-- Popup en JS pour changer l'avatar -->
    <?php
    
        Modal::begin([
            'id' => 'modal',
            
        ]);

        echo '<div id="picture-popup"></div>';

        Modal::end();
    
    ?>

    

    <div id="userAttributes" class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>En savoir plus sur toi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($account->age): ?>
                <tr>
                    <td>Age virtuel</td>
                    <td><?= $account->age ?></td>
                </tr>
                <?php endif; ?>
                
                <?php if($account->sex): ?>                
                <tr>
                    <td>Sexe</td>
                    <td><?= $account->sex ?></td>                
                </tr>
                <?php endif; ?>
                
                <?php if($account->why_register): ?>                
                <tr>
                    <td>Pourquoi t'inscrire sur Echos-Libres.fr ?</td>
                    <td><?= $account->why_register ?></td>                
                </tr> 
                <?php endif; ?>
                
                <?php if($account->skills): ?>                
                <tr>
                    <td>Savoir / Compétences à partager</td>
                    <td><?= $account->skills ?></td>                
                </tr>
                <?php endif; ?>
                
                <?php if($account->interests): ?>                
                <tr>
                    <td>Centres d'intérêt</td>
                    <td><?= $account->interests ?></td>                
                </tr>
                <?php endif; ?>
                
            </tbody>
        </table>    
    </div>

    <div id="userExpression" class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Expression libre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Passé</td>
                    <td><?= $account->past ?></td>
                </tr>
                <tr>
                    <td>Présent</td>
                    <td><?= $account->present ?></td>                
                </tr>
                <tr>
                    <td>Futur</td>
                    <td><?= $account->future ?></td>                
                </tr>            
            </tbody>
        </table>    
    </div>
</div>


<div id="userOther" class="">
    
    <?php if($account->newsletter): ?>
        <span>Newsletter : <i>Inscrit</i></span>
        <span class="btn"><a href="<?= Url::to(['user/newsletter', 'sub' => 0]) ?>">Désinscription</a></span>
    <?php else: ?>
        <span>Newsletter : <i>Non-inscrit</i></span>
        <span class="btn"><a href="<?= Url::to(['user/newsletter', 'sub' => 1]) ?>">Inscription</a></span>
    <?php endif; ?>
        
</div>
