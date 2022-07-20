<?php

namespace App\Models;

use CodeIgniter\Model;

class AktifitasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'aktifitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul', 'id_kegiatan', 'tanggal', 'id_modul', 'id_tahun_ajaran', 'id_matakuliahs', 'file_bukti', 'id_mahasiswa_aktifitas', 'deskripsi', 'slug_aktifitas'];

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

    public function viewTimelineFeedback($username)
    {
        return $this->db->table('aktifitas')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->where('nim', $username)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get()->getResultArray();
    }

    public function viewFeedback()
    {
        return $this->db->table('feedbackaktifitas')
            ->join('users', 'users.id=feedbackaktifitas.id_user')
            ->orderBy('id_feedback', 'DESC')
            ->limit(6)
            ->get()->getResultArray();
    }

    public function countViewFeedback()
    {
        return $this->db->table('feedbackaktifitas')
            ->select('id_aktifitas')
            ->selectCount('feedback', 'jumlah')
            ->join('users', 'users.id=feedbackaktifitas.id_user')
            ->get()->getRowArray();
    }

    public function viewAktifitas($nim)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id', 'id_aktifitas')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->where('mahasiswas.nim', $nim)->orderBy('tanggal', 'DESC')->get()->getResultArray();
    }

    public function viewDetailAktifitas($id_aktifitas)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('matakuliahs', 'matakuliahs.id=aktifitas.id_matakuliahs')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('users', 'mahasiswas.nim=users.username')
            ->join('tahunajarans', 'tahunajarans.id=aktifitas.id_tahun_ajaran')
            ->join('programstudis', 'mahasiswas.id_ps=programstudis.id')
            ->where('aktifitas.id', $id_aktifitas)->get()->getRowArray();
    }

    public function viewDetailAktifitasDosen($id_mahasiswa)
    {
        return $this->db->query('SELECT *, aktifitas.id as id_aktifitas FROM aktifitas JOIN kegiatans ON kegiatans.id=aktifitas.id_kegiatan JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas JOIN dosens ON dosens.id=mahasiswas.id_pa JOIN matakuliahs ON matakuliahs.id=aktifitas.id_matakuliahs WHERE aktifitas.id_mahasiswa_aktifitas=' . $id_mahasiswa . '')->getResultArray();
    }

    public function viewDetailAktifitasSemester($id_tahun_ajaran, $id_mahasiswa)
    {
        return $this->db->query('SELECT *, aktifitas.id as id_aktifitas FROM aktifitas JOIN kegiatans ON kegiatans.id=aktifitas.id_kegiatan JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas JOIN dosens ON dosens.id=mahasiswas.id_pa JOIN matakuliahs ON matakuliahs.id=aktifitas.id_matakuliahs WHERE aktifitas.id_mahasiswa_aktifitas=' . $id_mahasiswa . ' AND aktifitas.id_tahun_ajaran=' . $id_tahun_ajaran . '')->getResultArray();
    }
}
