<?php

namespace backend\controllers;

use Yii;
use common\models\SitePage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use common\models\SiteCategory;
use common\models\User;

/**
 * PageController implements the CRUD actions for SitePage model.
 */

class ModerationController extends Controller
{
    /**
     * Crée un commentaire de modération sur une page
     * @param id_page : ID de la page
     * @return bool|View : retourne un formulaire de création du commentaire / true si le formulaire est OK / false sinon
     */
    public function actionCreateForPage($id_page)
    {
        
    }
    
    /**
     * Crée un commentaire de modération sur un article
     */
    public function actionCreateForArticle($id_article)
    {
        
    }
}