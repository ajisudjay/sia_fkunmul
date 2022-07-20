<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'username', 'nama_user', 'password', 'role', 'jk', 'foto', 'foto_cover', 'id_user_ps'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function hapus($nim)
    {
        $this->db->table('users')->delete('username', $nim);
    }

    public function viewBeranda($username)
    {
        return $this->db->table('mahasiswas')->join('users', 'mahasiswas.nim=users.username')->join('programstudis', 'programstudis.id=mahasiswas.id_ps')->join('angkatans', 'angkatans.id=mahasiswas.id_angkatan')->join('dosens', 'dosens.id=mahasiswas.id_pa')->where('mahasiswas.nim', $username)->get()->getRowArray();
    }

    public function viewBerandaDosen($username)
    {
        return $this->db->table('dosens')->join('users', 'dosens.nip=users.username')->join('programstudis', 'programstudis.id=dosens.id_ps')->where('dosens.nip', $username)->get()->getRowArray();
    }
}
