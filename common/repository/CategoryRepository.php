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
 * Description of CategoryRepository
 *
 * @author Alexis
 */
class CategoryRepository extends Repository {

    /**
     * Récupère toutes les category
     * @param Array $params : orderBY, limit etc.
     */
    public function getAll($where=null, $params=null){
        $query=new Query;
        $query->select('*')
                ->from('forum_category');
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
    
    public function getThemes($params=null){
        $query=new Query;
        $query->select('id, title, description, status, id_category')
                ->from('forum_category')
                ->where(['id_category' => NULL]);
                
 
        
        $items=$query->all();
        if($items!=null){
            return $items;
        }

        
    }
}
