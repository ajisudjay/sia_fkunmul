<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressAktifitasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'progressaktifitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_aktifitas', 'id_mahasiswa', 'id_dosen', 'progress', 'tanggal'];

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

    public function count($id_aktifitas)
    {
        return $this->db->query("SELECT *, COUNT(progress) as jumlah FROM progressaktifitas WHERE id_aktifitas=$id_aktifitas")
            ->getRowArray();
    }
}
