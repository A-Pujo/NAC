<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
    protected $table      = 'users';

    protected $returnType     = 'object';

    protected $allowedFields = ['nama', 'oauth_id', 'email', 'avatar'];

    protected $useTimestamps = true;
    protected $createdField  = 'user_dibuat';
    protected $updatedField  = 'user_diupdate';

    function isAlreadyRegistered($oauth_id){
        return ($this->where(['oauth_id' => $oauth_id])->first() != null) ? true : false;
    }
}

?>