<?php

namespace App\Models;

use CodeIgniter\Model;

class KoneksiModel extends Model
{
    public function koneksi()
    {
        $koneksi = $this->db->connect();
        return $koneksi;
    }
}
