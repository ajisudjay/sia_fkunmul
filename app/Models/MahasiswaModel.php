<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mahasiswas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_ps', 'id_fak', 'nama_mahasiswa', 'nim', 'alamat', 'telepon', 'email', 'status', 'id_angkatan', 'jk', 'id_pb1', 'id_pb2', 'id_pa', 'id_dosen_ipe'];

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

    public function edit($data, $nim)
    {
        return $this->db->table('mahasiswas')->update($data, ['nim' => $nim]);
    }

    public function editMahasiswa($data, $id)
    {
        return $this->db->table('mahasiswas')->update($data, ['id_mahasiswa' => $id]);
    }

    public function editUser($data, $nim)
    {
        return $this->db->table('users')->update($data, ['username' => $nim]);
    }

    public function hapus($id)
    {
        return $this->db->table('mahasiswas')->delete(['id_mahasiswa' => $id]);
    }

    public function hapusUser($nim)
    {
        return $this->db->table('users')->delete(['username' => $nim]);
    }

    public function cekNim($nim)
    {
        return $this->db->table('mahasiswas')
            ->where('nim', $nim)
            ->get()->getRowArray();
    }
}
