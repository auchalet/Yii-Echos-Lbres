<?php

/*
 * Classe pour gérer les intéractions BD avec l'objet Category
 * 
 * 
 */

namespace common\repository;
use Yii;
use yii\db\Query;
use yii\db\Connection;
use yii\db\Command;
use yii\db\Exception;

/**
 * 
 *
 * @author Alexis
 */
class TopicRepository extends Repository {

    /**
     * Récupère tous les topics
     * @param Array $params : orderBY, limit etc.
     */
    public function getAll($where=null, $params=null){
        $query=new Query;
        $query->select('*')
                ->from('forum_topic');
        //var_dump($where);
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
