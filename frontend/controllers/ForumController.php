<?php

/**
 * Contrôleur du forum
 * Fonctions pour gérer l'objet forum
 */

namespace frontend\controllers;
use common\repository\PostRepository;
use common\repository\CategoryRepository;
use common\repository\TopicRepository;
use frontend\models\ForumPost;
use common\models\User;
use yii\data\Pagination;
use yii\base\Object;


class ForumController extends \yii\web\Controller
{
    public function actionCategory()
    {
        return $this->render('category');
    }

    public function actionIndex()
    {
        $categoryRepo=new CategoryRepository();
        $categories=$categoryRepo->getAll();
                
        return $this->render('index', [
            'categories'=>$categories
        ]);
    }

    /**
     * 
     * @param int $id_category : l'ID de la category
     * @return la vue forum/topics : tous les topics d'une categorie
     */
    public function actionTopics($id_category)
    {
        //Code à changer avec les topics : PostRepository puis récupérer les topics de la catégorie
        $topicRepo=new TopicRepository;
        $topics=$topicRepo->getAll("id_category=$id_category", ['orderBy'=>'createdAt']);
        return $this->render('topics',
                ['topics'=>$topics,
                 'id_category'=>$id_category
                ]);
    }    
    
    
    /**
     * 
     * @param int $id_topic : l'ID du topic
     * @return la vue forum/posts : tous les posts d'un topic
     */
    public function actionPosts($id_topic)
    {
    	$postRepo=new PostRepository;
    	 
    	$countQuery=$postRepo->count('forum_post',"id_topic=$id_topic");
    	
    	//Pagination : 5 Items par page
    	$pages=new Pagination([
    			'pageSize'=>5,
    			'totalCount'=>$countQuery[0]['ctr']
    	]);    	
    	
    	//GetAll avec Pagination
        $posts=$postRepo->getAll("id_topic=$id_topic", [
        		'orderBy'=>[
        				'createdAt'=>SORT_ASC
        				],
        		'offset'=>$pages->offset,
        		'limit'=>$pages->limit
        		
        ]);
        
		//var_dump($pages);
        
        $topicRepo=new TopicRepository;
        $topic=$topicRepo->getAll("id=$id_topic");
        
        foreach($posts as $k => $v){
            $user=User::findOne($v['id_user']);
            $users[$k]=$user->attributes;
        }
        
        
        //$author=$user->findIdentity($posts['id_user']);
        return $this->render('posts',[
        		'topic'=>$topic, 
        		'posts'=>$posts, 
        		'author'=>$users,
        		'pages'=>$pages
        ]);
    }
    

    
    

}
