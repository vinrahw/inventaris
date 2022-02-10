<?php

namespace App\Models;

use CodeIgniter\Model;

class LabgamedModel extends Model
{
    protected $table = 'labgamed';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'jumlah', 'spesifikasi_lab', 'cctv', 'keterangan'];

    public function getLabgamed($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }
}
