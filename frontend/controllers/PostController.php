<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ForumPost;
use frontend\models\ForumPostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\repository\PostRepository;

/**
 * PostController implements the CRUD actions for ForumPost model.
 */
class PostController extends Controller
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
     * Lists all ForumPost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ForumPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ForumPost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ForumPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ForumPost();
        $model->createdAt=date("Y-m-d H:i:s", time());
        $model->updatedAt=date("Y-m-d H:i:s", time());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ForumPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updatedAt=date("Y-m-d H:i:s", time());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['forum/posts', 'id_topic' => $model->id_topic]);
        } else {
            
            
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ForumPost model.
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
     * Finds the ForumPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ForumPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ForumPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    /**
     * Action réponse : Affiche un formulaire _answer (à changer en anwer qui redirige vers le _answer)
     * Si formulaire rempli, ajoute le post et redirige vers le topic
     * @param int $id_topic
     * @return vue 
     */
    public function actionAnswer($id_topic) {

        $model = new ForumPost();
        $model->title=NULL;
        $model->id_topic=intval($id_topic);
        $model->id_user=Yii::$app->user->id;        
        $model->createdAt=date("Y-m-d H:i:s", time());
        $model->updatedAt=date("Y-m-d H:i:s", time());

        
        $post=Yii::$app->request->getBodyParam('ForumPost');
        
        if(isset($post)&&!empty($post)){
            $postRepo=new PostRepository();
            $model->title=NULL;
            
            $model->content=$post['content'];
            if($postRepo->insert($model)){
                return $this->redirect(['/forum/posts', 'id_topic' => $model->id_topic]);
            }    


        }
        
        
        
        //Affichage du formulaire de reponse
        return $this->render('answer', [
                    'model' => $model
        ]);
    }
    
   
    /** Gestion du vote pour un Post : ne marche pas **/
    
    /**
     * Incr�mente le score du Post
     * @param int $id : l'ID du Post
     * @return la vue forum/posts
     */
    public function actionVote($id, $score){
    	 return $this->renderPartial('vote',['id'=>$id, 'score'=>$score]);
    }    
    
    
    /**
     * Incr�mente le score du Post
     * @param int $id : l'ID du Post
     * @return la vue forum/posts
     */
    public function actionVoteup($id=null){
        
        if($id==null && isset($_POST['id']) && !empty($_POST['id'])){
            $id=$_POST['id'];
        }
        
    	$postRepo=new PostRepository();
    	$postRepo->vote('plus', "id=$id");
    	$post=$postRepo->getAll("id=$id");
    	
        
    	return $this->renderPartial('vote', ['id'=>$id, 'score'=>$post[0]['score']]);
    	
    }
    
    /**
     * D�cr�mente le score du Post
     * @param int $id : l'ID du Post
     * @return la vue forum/posts
     */
    public function actionVotedown($id=null){
        if($id==null && isset($_POST['id']) && !empty($_POST['id'])){
            $id=$_POST['id'];
        }
    	$postRepo=new PostRepository();
    	$postRepo->vote('moins', "id=$id");
    	$post=$postRepo->getAll("id=$id");
    	
    	return $this->renderPartial('vote', ['id'=>$id, 'score'=>$post[0]['score']]);
    }

}
