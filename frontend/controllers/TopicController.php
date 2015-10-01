<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ForumTopic;
use frontend\models\ForumTopicSearch;
use frontend\models\ForumPost;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\base\Object;

/**
 * TopicController implements the CRUD actions for ForumTopic model.
 */
class TopicController extends Controller
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
     * Lists all ForumTopic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ForumTopicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ForumTopic model.
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
     * Creates a new ForumTopic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_category=null)
    {
        $model = new ForumTopic();
        $model->createdAt=date("Y-m-d H:i:s", time());
        $model->updatedAt=date("Y-m-d H:i:s", time());
        $model->id_user=Yii::$app->user->id;
        $model->status=0;
        
        if($id_category!=null){
        	$model->id_category=$id_category;
        }
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    
    /**
     * Creates a new Topic with a first Post
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNew($id_category)
    {
    	//Création du Topic
    	$topic = new ForumTopic();
    	$topic->createdAt=date("Y-m-d H:i:s", time());
    	$topic->updatedAt=date("Y-m-d H:i:s", time());
    	$topic->id_category=$id_category;
    	$topic->id_user=Yii::$app->user->id;
    	$topic->status=0;
    
    	
    	
    	$post=new ForumPost();
    
    	
    	//Test remplissage du formulaire
    	if ($topic->load(Yii::$app->request->post()) && $post->load(Yii::$app->request->post())) {
    		
    		//Création du premier Post du topic
    		$post->title=$topic->title;
    		$post->score=0;
    		$post->createdAt=date("Y-m-d H:i:s", time());
    		$post->updatedAt=date("Y-m-d H:i:s", time());
    		$post->id_user=Yii::$app->user->id;
    		
    		
    		
    		if($topic->save()){

    			$post->id_topic=$topic->id;
    			
    			
    			if($post->save()){
    				
    				return $this->redirect(['/forum/posts', 'id_topic' => $topic->id]);
    			}
    			
    		}
    		
    	}
    	
    	//Si formulaire mal rempli OU echec sauvegarde, renvoie le formulaire
    	return $this->render('new', [
    			'model' => $topic,
    			'post' => $post
    	]);
    
    }
    
    

    /**
     * Updates an existing ForumTopic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updatedAt=date("Y-m-d H:i:s", time());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ForumTopic model.
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
     * Finds the ForumTopic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ForumTopic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ForumTopic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
