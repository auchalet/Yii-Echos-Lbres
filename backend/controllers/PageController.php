<?php

namespace backend\controllers;

use Yii;
use common\models\SitePage;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SiteCategory;
use common\models\User;
use common\models\Tag;
use common\models\SitePageTag;

/**
 * PageController implements the CRUD actions for SitePage model.
 */
class PageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Liste les catégories de pages
     * @return mixed
     */
    public function actionListPages($id_category)
    {        
        $category = SiteCategory::getById($id_category);
        $pages = $category->getSitePages();

        $users = array();
        $tags = array();
        if($pages) {
            foreach($pages as $v) {
                $users[] = User::findId($v->user_id);
                $tags[] = $v->getTags();
                //Récupération binaire des statuts 1 = OK ; 0 = !OK // SUPPRIME : on reste sur 1-2-3-4-5
//                $status_bin = str_split((string)$v->status);
//                $status[] = $status_bin;

            }
        }
       
        

        return $this->render('list-pages', [
            'category' => $category,
            'pages' => $pages,
            'users' => $users,
            'tags' => $tags
        ]);
    }

    /**
     * Displays a single SitePage model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewPage($id)
    {
        return $this->render('view-page', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SitePage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePage($id_category)
    {
        $model = new SitePage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create-page', [
                'model' => $model,
            ]);
        }
    }
    

    /**
     * Updates an existing SitePage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tags_page = new SitePageTag;
        //$tags_page = $model->getTags();
        
        $tags = Tag::getAllTitle();

        $tags_title = array();
        foreach($tags as $v) {
            array_push($tags_title, $v['title']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            
            
            return $this->render('update', [
                'model' => $model,
                'tags' => $tags_title,
                'tags_page' => $tags_page
            ]);
        }
    }

    /**
     * Deletes an existing SitePage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    
    /**
     * Crée une Site_Category : nouvelle rubrique de pages du site
     * Si Succès, redirige vers la création d'une page
     * @return mixed
     */
    public function actionCreateCategory()
    {
        $model = new SiteCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create-page', 'id_category' => $model->id]);
        } else {
            return $this->render('create-category', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Finds the SitePage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SitePage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SitePage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
