<?php

namespace common\repository;

use Yii;
use yii\db\Query;
use yii\db\Connection;
/**
 * Fonctions gérant les requêtes SQL
 *
 * @author Alexis
 */
class Repository {
    //put your code here
    protected $db;
    protected $connection;
        
    public function __construct() {
        
        $dsn = 'mysql:dbname=yii;host=127.0.0.1';
        $user = 'root';
        $password = '';  
        
        $this->db = new Connection([
            'dsn' => $dsn,
            'username' => $user,
            'password' => $password,
        ]);        
    }
    
}
