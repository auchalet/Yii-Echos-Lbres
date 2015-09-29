<?php

/**
 * Gestion des requêtes BD pour les Post
 */

namespace common\repository;
use Yii;
use yii\db\Query;
use yii\db\Connection;
use yii\db\Command;
 

/*
 * @author Alexis
 */

class PostRepository extends Repository {
    
    /**
     * 
     */
    public function getAll($where=null,$params=null) {
        $query = new Query;
        $query  ->select('*')
                ->from('forum_post');
        
        if($where!=null){
            if(is_string($where)){
                $query->where($where);
            }
            else{
                throw new Exception('Erreur : la clause Where doit être une chaîne de caractères');
            }
        }
        $items=$query->all();
        
        return $items;
    }
    
    /**
     * Insertion d'un forum_post (à compléter)
     * @param Post $post
     * @param type $where
     * @param type $params
     */
    public function insert($post, $where=null, $params=null){
        
        if($post->title==null){
            $query=$this->db->createCommand("INSERT INTO forum_post (content, score, id_user, id_topic, createdAt, updatedAt) VALUES ('$post->content', 0, $post->id_user, $post->id_topic, '$post->createdAt', '$post->updatedAt' )");
        }
        else{
            $query=$this->db->createCommand("INSERT INTO forum_post (title, content, score, id_user, id_topic, createdAt, updatedAt) VALUES ('$post->title', '$post->content', 0, $post->id_user, $post->id_topic, '$post->createdAt', '$post->updatedAt' )");
        }
        
        if($query->execute()){
            return true;
        }else{
            throw new Exception('Erreur dans la création du Post');
        }
        
        
    }
    
    /**
     * Update le score du Post
     */
    public function vote($type,$where=null){
    	if($type=="plus"){
    		$query=$this->db->createCommand("UPDATE forum_post
    				SET score=score+1
    				WHERE $where");
    	}
    	elseif($type=="moins"){
    		$query=$this->db->createCommand("UPDATE forum_post
    				SET score=score-1
    				WHERE $where");
    	}
    	elseif($type="reset"){
    		$query=$this->db->createCommand("UPDATE forum_post
    				SET score=0
    				WHERE $where");
    	}
    	
    	if($query->execute()){
    		return true;
    	}
    	else{
    		throw new Exception('Erreur dans la modification du score');
    	}
    	
    }

}
