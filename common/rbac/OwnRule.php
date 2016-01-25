<?php

namespace common\rbac; 

use yii\rbac\Rule;


class OwnRule extends Rule
{
    public $name = 'isOwn';
    
    public function execute($user, $item, $params) {
                    var_dump($params, $user); die;

        if(isset($params['user'])) {
            if($params['user']===$user) {
                return true;
            }
        }
        
        
        return isset($params['item']) ? $params['item']->createdBy == $user : false;
    }

}
