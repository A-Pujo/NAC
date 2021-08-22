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

    function initUserInfo($oauth_id){
        $user = $this->db->table('users')->where(['oauth_id' => $oauth_id])->get()->getRowArray();
        
        // isi roles
        $this->db->table('role_user_groups')->insert([
            'user_id' => $user['id'],
            'role_id' => 0,
        ]);

        // isi pembayaran
        $this->db->table('data_pembayaran')->insert([
            'user_id' => $user['id'],
        ]);

        // isi data partisipan
        $this->db->table('data_partisipan')->insert([
            'user_id' => $user['id'],
        ]);
    }

    function isAlreadyRegistered($oauth_id){
        return ($this->where(['oauth_id' => $oauth_id])->first() != null) ? true : false;
    }

    function getFullUserInfo(){
        return $this->join('data_partisipan', 'data_partisipan.user_id = users.id')->join('data_pembayaran', 'data_pembayaran.user_id = users.id')
            ->where(['email' => session()->get('loggedEmail')])->first();
    }
}

?>