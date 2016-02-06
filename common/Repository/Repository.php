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
        
        $dsn = 'mysql:dbname=hvtv;host=127.0.0.1';
        $user = 'hvtv';
        $password = '200phoenix';  
        
        $this->db = new Connection([
            'dsn' => $dsn,
            'username' => $user,
            'password' => $password,
        ]);        
    }
    
}
