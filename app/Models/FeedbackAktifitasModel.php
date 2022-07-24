<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackAktifitasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'feedbackaktifitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_aktifitas', 'feedback', 'id_user', 'waktu', 'status', 'penerima', 'pengirim'];

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

    public function ubah($data_update, $id_aktifitas, $id_user)
    {
        return $this->db->table('feedbackaktifitas')->update($data_update, ['id_aktifitas' => $id_aktifitas, 'penerima' => $id_user]);
    }

    public function count($id_penerima, $id_aktifitas)
    {
        return $this->db->query("SELECT *, COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas=$id_aktifitas AND status='new' AND penerima=$id_penerima")->getRowArray();
    }

    // public function countMahasiswa($id_penerima, $id_aktifitas)
    // {
    //     return $this->db->query("SELECT *, COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas=$id_aktifitas AND status='new' AND penerima=$id_penerima")->getRowArray();
    // }
}
