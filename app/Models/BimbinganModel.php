<?php

namespace App\Models;

use CodeIgniter\Model;

class BimbinganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bimbingans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_mahasiswa', 'id_dosen'];

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

    public function viewDataJoinDosen($id_ps, $id_angkatan)
    {
        return $this->db->table('mahasiswas')->join('dosens', 'dosens.id=mahasiswas.id_pa')->where(['mahasiswas.id_ps' => $id_ps, 'mahasiswas.id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray();
    }

    public function viewData($id_ps, $id_angkatan)
    {
        return $this->db->table('mahasiswas')->join('dosens', 'dosens.id=mahasiswas.id_pa')->where(['mahasiswas.id_ps' => $id_ps, 'mahasiswas.id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray();
    }

    public function viewDataDetail($id)
    {
        return $this->db->table('mahasiswas')->join('dosens', 'dosens.id=mahasiswas.id_pa')->where('mahasiswas.id_mahasiswa', $id)->get()->getRowArray();
    }

    public function edit($data, $id)
    {
        return $this->db->table('mahasiswas')->update($data, ['id_mahasiswa' => $id]);
    }
}
