<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dosens';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_ps', 'id_fak', 'nama_dosen', 'nip', 'alamat', 'telepon', 'email', 'id_status_dosen', 'jk', 'status_ajar'];

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

    public function view()
    {
        return $this->db->table('dosens')
            ->where(['status_ajar' => 'aktif'])
            ->orderBy('nama_dosen', 'ASC')
            ->get()->getResultArray();
    }

    public function viewDosen()
    {
        return $this->db->table('dosens')
            ->join('programstudis', 'programstudis.id=dosens.id_ps')
            ->join('fakultas', 'fakultas.id=dosens.id_fak')
            ->join('statusdosens', 'statusdosens.id=dosens.id_status_dosen')
            ->get()->getRowArray();
    }


    public function edit($data, $nip)
    {
        return $this->db->table('dosens')->update($data, ['nip' => $nip]);
    }

    public function editUser($data, $nip)
    {
        return $this->db->table('users')->update($data, ['username' => $nip]);
    }

    public function hapusUser($nip)
    {
        return $this->db->table('users')->delete(['username' => $nip]);
    }

    public function cekNip($nip)
    {
        return $this->db->table('dosens')
            ->where('nip', $nip)
            ->get()->getRowArray();
    }

    public function input()
    {
        return $this->db->table('dosens')
            ->insert();
    }
}
