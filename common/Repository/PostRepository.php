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

}
