<?php

namespace App\Models;

use CodeIgniter\Model;

class MonitoringModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'monitorings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_matakuliah', 'id_fak', 'id_ps', 'id_ta', 'id_kelas', 'id_paket_semester', 'id_dosen', 'pertemuan', 'materi', 'rps', 'taggal_rencana', 'tanggal_realisasi', 'jam_rencana', 'jam_realisasi', 'status', 'keterangan', 'slug_mk'];

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

    public function viewMonitoringOperator($id_fak, $id_ps, $id_ta)
    {
        return $this->db->table('monitorings')->join('matakuliahs', 'matakuliahs.id=monitorings.id_matakuliah')->join('kelas', 'kelas.id=monitorings.id_kelas')->join('dosens', 'dosens.id=monitorings.id_dosen')->where(['monitorings.id_fak' => $id_fak, 'monitorings.id_ps' => $id_ps, 'monitorings.id_ta' => $id_ta])->groupBy('monitorings.id_matakuliah')->get()->getResultArray();
    }

    public function namaMatakuliahMonitoring($id_fak, $id_ps, $id_ta, $id_kelas, $id_matakuliah)
    {
        return $this->db->table('monitorings')
            ->join('programstudis', 'programstudis.id=monitorings.id_ps')
            ->join('tahunajarans', 'tahunajarans.id=monitorings.id_ta')
            ->join('matakuliahs', 'matakuliahs.id=monitorings.id_matakuliah')
            ->join('kelas', 'kelas.id=monitorings.id_kelas')
            ->join('dosens', 'dosens.id=monitorings.id_dosen')
            ->where(['monitorings.id_fak' => $id_fak, 'monitorings.id_ps' => $id_ps, 'monitorings.id_ta' => $id_ta, 'monitorings.id_kelas' => $id_kelas, 'monitorings.id_matakuliah' => $id_matakuliah])
            ->groupBy('monitorings.id_matakuliah')
            ->get()->getRowArray();
    }

    public function viewEdit($id)
    {
        return $this->db->table('monitorings')
            ->join('programstudis', 'programstudis.id=monitorings.id_ps')
            ->join('tahunajarans', 'tahunajarans.id=monitorings.id_ta')
            ->join('matakuliahs', 'matakuliahs.id=monitorings.id_matakuliah')
            ->join('kelas', 'kelas.id=monitorings.id_kelas')
            ->join('dosens', 'dosens.id=monitorings.id_dosen')
            ->where('monitorings.id_monitoring', $id)
            ->get()->getRowArray();
    }

    public function viewMonitoringDetailOperator($id_fak, $id_ps, $id_ta, $id_kelas, $id_matakuliah)
    {
        return $this->db->table('monitorings')
            ->join('programstudis', 'programstudis.id=monitorings.id_ps')
            ->join('tahunajarans', 'tahunajarans.id=monitorings.id_ta')
            ->join('matakuliahs', 'matakuliahs.id=monitorings.id_matakuliah')
            ->join('kelas', 'kelas.id=monitorings.id_kelas')
            ->join('dosens', 'dosens.id=monitorings.id_dosen')
            ->where(['monitorings.id_fak' => $id_fak, 'monitorings.id_ps' => $id_ps, 'monitorings.id_ta' => $id_ta, 'monitorings.id_kelas' => $id_kelas, 'monitorings.id_matakuliah' => $id_matakuliah])
            ->get()->getResultArray();
    }
}
