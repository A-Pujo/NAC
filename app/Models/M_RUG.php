<?php

namespace App\Models;

use CodeIgniter\Model;

class M_RUG extends Model
{
    protected $table      = 'role_user_groups';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'role_id'];
    
    function getAllUserRole(){
        return $this->join('users', 'users.id = role_user_groups.user_id')->join('roles', 'roles.role_id = role_user_groups.role_id')->findAll();
    }

    function setUserRole($user_id, $role_id){
        $this->where(['user_id' => $user_id, ])->update(null, ['role_id' => $role_id]);
    }
}

?>