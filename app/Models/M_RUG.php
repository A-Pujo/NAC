<?php

namespace App\Models;

use CodeIgniter\Model;

class M_RUG extends Model
{
    protected $table      = 'role_user_groups';

    protected $returnType     = 'object';

    protected $allowedFields = ['user_id', 'role_id'];
    
    function setUserRole($user, $role){
        $this->where(['user_id' => $user, ])->update(null, ['role_id' => $role]);
    }
}

?>