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
     * @param int $id_category : l'ID de la catégory
     * @return la vue forum/topics : tous les topics d'une catégorie
     */
    public function actionTopics($id_category)
    {
        //Code à changer avec les topics : PostRepository puis récupérer les topics de la catégorie
        $topicRepo=new TopicRepository;
        $topics=$topicRepo->getAll("id_category=$id_category", ['orderBy'=>'createdAt']);
        return $this->render('topics',
                ['topics'=>$topics]);
    }    
    
    
    /**
     * 
     * @param int $id_topic : l'ID du topic
     * @return la vue forum/posts : tous les posts d'un topic
     */
    public function actionPosts($id_topic)
    {
        $postRepo=new PostRepository;
        $posts=$postRepo->getAll("id_topic=$id_topic", ['orderBy'=>'createdAt']);
        return $this->render('posts',['posts'=>$posts]);
    }
    
    /**
     * 
     * @param int $id_post : l'ID du post
     * @return la vue forum/post : détail du post
     */
    public function actionPost($id_post){
        $postRepo=new PostRepository();
        $post=$postRepo->getAll("id=$id_post");
        return $this->render('post',['post'=>$post]);
    }
    

    
    

}
