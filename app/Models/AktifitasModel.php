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
    protected $allowedFields    = ['judul', 'id_kegiatan', 'tanggal', 'id_modul', 'id_tahun_ajaran', 'id_matakuliahs', 'file_bukti', 'id_mahasiswa_aktifitas', 'deskripsi', 'slug_aktifitas', 'status_aktifitas', 'kompetensi_aktifitas', 'subkompetensi_aktifitas'];

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

    public function viewAktifitas($nim, $id_tahun_ajaran)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->where('mahasiswas.nim', $nim)
            ->where('id_tahun_ajaran', $id_tahun_ajaran)
            ->orderBy('aktifitas.id', 'DESC')->get()->getResultArray();
    }

    public function viewJumlahAktifitasDosen($nim)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('kompetensis.kompetensi', 'jumlah')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('tahunajarans', 'aktifitas.id_tahun_ajaran=tahunajarans.id')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->where('mahasiswas.nim', $nim)
            // ->where('jenis', 'REGULAR')
            ->groupBy('kompetensis.kompetensi')
            ->orderBy('kompetensis.id_kompetensi', 'ASC')->get()->getResultArray();
    }

    public function viewJumlahAktifitas($nim, $id_tahun_ajaran)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('kompetensis.kompetensi', 'jumlah')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->where('mahasiswas.nim', $nim)
            ->where('id_tahun_ajaran', $id_tahun_ajaran)
            // ->where('jenis', 'REGULAR')
            ->groupBy('kompetensis.kompetensi')
            ->orderBy('kompetensis.id_kompetensi', 'ASC')->get()->getResultArray();
    }


    public function viewJumlahSubAktifitas($nim, $id_tahun_ajaran)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('kompetensis.kompetensi', 'jumlah')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->where('mahasiswas.nim', $nim)
            ->where('id_tahun_ajaran', $id_tahun_ajaran)
            // ->where('jenis', 'REGULAR')
            ->groupBy('sub_kompetensi')
            ->orderBy('kompetensis.id_kompetensi', 'ASC')->get()->getResultArray();
    }

    public function viewJumlahAktifitasHome($nim)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('kompetensis.kompetensi', 'jumlah')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('tahunajarans', 'aktifitas.id_tahun_ajaran=tahunajarans.id')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->where('mahasiswas.nim', $nim)
            // ->where('id_tahun_ajaran', $id_tahun_ajaran)
            // ->where('jenis', 'REGULAR')
            // ->groupBy('kompetensis.kompetensi')
            ->groupBy('id_tahun_ajaran')
            ->orderBy('tahunajarans.id', 'ASC')->get()->getResultArray();
    }

    public function viewJumlahAktifitasGrafik($nim)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('kompetensis.kompetensi', 'jumlah')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('tahunajarans', 'aktifitas.id_tahun_ajaran=tahunajarans.id')
            ->where('mahasiswas.nim', $nim)
            // ->where('id_tahun_ajaran', $id_tahun_ajaran)
            // ->where('jenis', 'REGULAR')
            ->groupBy('id_tahun_ajaran')
            ->groupBy('kompetensis.kompetensi')
            ->orderBy('tahunajarans.id', 'ASC')->get()->getResultArray();
    }

    public function viewJumlahSubAktifitasHome($nim)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('subkompetensis.sub_kompetensi', 'jumlah')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->where('mahasiswas.nim', $nim)
            // ->where('id_tahun_ajaran', $id_tahun_ajaran)
            // ->where('jenis', 'REGULAR')
            ->groupBy('id_tahun_ajaran')
            ->groupBy('kompetensis.kompetensi')
            ->groupBy('subkompetensis.sub_kompetensi')
            ->get()->getResultArray();
    }

    public function viewDetailAktifitas($id_aktifitas)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id AS id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('users', 'mahasiswas.nim=users.username')
            ->join('tahunajarans', 'tahunajarans.id=aktifitas.id_tahun_ajaran')
            ->join('angkatans', 'mahasiswas.id_angkatan=angkatans.id')
            ->join('programstudis', 'mahasiswas.id_ps=programstudis.id')
            ->where('aktifitas.id', $id_aktifitas)
            ->get()->getRowArray();
    }

    public function viewDetailAktifitasDosen($id_mahasiswa)
    {
        return $this->db->query("SELECT *, aktifitas.id as id_aktifitas FROM aktifitas JOIN kegiatans ON kegiatans.id=aktifitas.id_kegiatan JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas JOIN dosens ON dosens.id=mahasiswas.id_pa JOIN matakuliahs ON matakuliahs.id=aktifitas.id_matakuliahs WHERE aktifitas.id_mahasiswa_aktifitas=$id_mahasiswa ORDER BY id_aktifitas DESC")->getResultArray();
    }

    public function viewDetailAktifitasSemester($id_mahasiswa, $id_tahun_ajaran)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('dosens', 'dosens.id=mahasiswas.id_pa')
            ->join('tahunajarans', 'tahunajarans.id=aktifitas.id_tahun_ajaran')
            ->join('angkatans', 'mahasiswas.id_angkatan=angkatans.id')
            ->join('programstudis', 'mahasiswas.id_ps=programstudis.id')
            ->where('aktifitas.id_mahasiswa_aktifitas', $id_mahasiswa)
            ->where('aktifitas.id_tahun_ajaran', $id_tahun_ajaran)
            ->where('jenis', 'REGULAR')
            ->orderBy('status_aktifitas', 'ASC')
            ->orderBy('aktifitas.id', 'DESC')
            ->get()->getResultArray();
    }

    public function viewDetailDosen($id_dosen)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('dosens', 'dosens.id=mahasiswas.id_pa')
            ->join('tahunajarans', 'tahunajarans.id=aktifitas.id_tahun_ajaran')
            ->join('angkatans', 'mahasiswas.id_angkatan=angkatans.id')
            ->join('programstudis', 'mahasiswas.id_ps=programstudis.id')
            ->where('mahasiswas.id_pa', $id_dosen)
            ->groupBy('nim')
            ->orderBy('angkatan', 'DESC')
            ->get()->getResultArray();
    }

    public function viewDetailDosenPa($id_mahasiswa)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->selectCount('kompetensis.kompetensi', 'jumlah')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('dosens', 'dosens.id=mahasiswas.id_pa')
            ->join('tahunajarans', 'tahunajarans.id=aktifitas.id_tahun_ajaran')
            ->join('angkatans', 'mahasiswas.id_angkatan=angkatans.id')
            ->join('programstudis', 'mahasiswas.id_ps=programstudis.id')
            ->where('mahasiswas.id_mahasiswa', $id_mahasiswa)
            ->orderBy('status_aktifitas', 'ASC')
            ->orderBy('aktifitas.id', 'DESC')
            ->get()->getResultArray();
    }

    public function viewSearchAktifitasSemester($id_mahasiswa, $id_tahun_ajaran, $cari)
    {
        return $this->db->query("SELECT *, aktifitas.id as id_aktifitas FROM aktifitas JOIN kegiatans ON kegiatans.id=aktifitas.id_kegiatan JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas JOIN dosens ON dosens.id=mahasiswas.id_pa WHERE aktifitas.id_mahasiswa_aktifitas=$id_mahasiswa AND aktifitas.id_tahun_ajaran= $id_tahun_ajaran ORDER BY id_aktifitas DESC")->getResultArray();
    }

    public function viewDetailNotifDosen($slug_aktifitas)
    {
        return $this->db->query("SELECT *, aktifitas.id as id_aktifitas FROM aktifitas JOIN kegiatans ON kegiatans.id=aktifitas.id_kegiatan JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas JOIN dosens ON dosens.id=mahasiswas.id_pa JOIN matakuliahs ON matakuliahs.id=aktifitas.id_matakuliahs WHERE aktifitas.slug_aktifitas=$slug_aktifitas")->getRowArray();
    }

    public function count($id_pa)
    {
        return $this->db->query("SELECT *, COUNT(status_aktifitas) as jumlah FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa WHERE aktifitas.status_aktifitas='new' AND mahasiswas.id_pa='$id_pa'")->getRowArray();
    }

    public function aktifitasViewDosen($usernamae, $id_tahun_ajaran)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->join('kegiatans', 'kegiatans.id=aktifitas.id_kegiatan')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('dosens', 'dosens.id=mahasiswas.id_pa')
            ->where('dosens.nip', $usernamae)
            ->where('id_tahun_ajaran', $id_tahun_ajaran)
            ->groupBy('nim')
            ->get()->getResultArray();
    }

    // IPE //

    public function viewIpeDosen($id_dosen, $id_tahun_ajaran)
    {
        return $this->db->table('aktifitas')
            ->select('*')
            ->select('aktifitas.id as id_aktifitas')
            ->select('kompetensis.kompetensi as data_kompetensi')
            ->join('kegiatans', 'aktifitas.id_kegiatan=kegiatans.id')
            ->join('kompetensis', 'aktifitas.kompetensi_aktifitas=kompetensis.id_kompetensi')
            ->join('subkompetensis', 'aktifitas.subkompetensi_aktifitas=subkompetensis.id_sub_kompetensi', 'left')
            ->join('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')
            ->join('dosens', 'dosens.id=mahasiswas.id_pa')
            ->join('tahunajarans', 'tahunajarans.id=aktifitas.id_tahun_ajaran')
            ->join('angkatans', 'mahasiswas.id_angkatan=angkatans.id')
            ->join('programstudis', 'mahasiswas.id_ps=programstudis.id')
            ->where('mahasiswas.id_dosen_ipe', $id_dosen)
            ->where('aktifitas.id_tahun_ajaran', $id_tahun_ajaran)
            ->where('kompetensis.jenis', 'IPE')
            ->orderBy('status_aktifitas', 'ASC')
            ->orderBy('aktifitas.id', 'DESC')
            ->get()->getResultArray();
    }
}
