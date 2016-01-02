<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
$this->title = 'Echos-Libres - Profil de '.$account->pseudo;
$this->params['breadcrumbs'][] = $this->title;

//Récupération du path du fichier
if($account->avatar) {
    $pathAvatar = '/uploads/'.sha1($user->username).'/'.$avatar->filename;
} else {
    $pathAvatar = '/uploads/'.sha1('base').'/avatar.jpg';
}

?>

<div id="header-profil">
    <div class="" style="float:left;">
        <h1>Profil : <?= $account->pseudo ?></h1>
        <ul>
            <li>Inscrit sur le site depuis le <?= Yii::$app->formatter->asDate($user->created_at); ?> </li>
            
            <?php if($member->paid === 1): ?>
            <li>Membre de l'asso depuis le <?= Yii::$app->formatter->asDate($member->adhesion); ?> </li>
            <?php endif; ?>
            
        </ul>
    </div>
    
    <div id="userSiteAttributes">
        <ul class="" style="display:inline;">            
            <li>Login : <?= $user->username ?></li>
            <li>Password : ********</li>           
            <li><a href="<?= Url::to(['user/update-logs']) ?>">Modifier</a>
        </ul>
    </div>
</div>

<div class="core-profil">
    
    <a href="<?= Url::to(['user/update-account']) ?>">Modifier le profil</a>
    
    
    <div id="avatar">

        <?= Html::img($pathAvatar, ['label'=>'Image', 'format'=>'raw']) ?>
        
        <a href="<?= Url::to(['user/change-avatar']) ?>">Ajouter un avatar <br> (compatible Gravatar)</a>
    </div>

    

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
        <span class="btn"><a href="<?= Url::to(['user/newsletter', 'sub' => 'unsubscribe']) ?>">Désinscription</a></span>
    <?php else: ?>
        <span>Newsletter : <i>Non-inscrit</i></span>
        <span class="btn"><a href="<?= Url::to(['user/newsletter', 'sub' => 'subscribe']) ?>">Inscription</a></span>
    <?php endif; ?>
        
</div>
