<?php

namespace App\Models;

use CodeIgniter\Model;

class ItsupportModel extends Model
{
    protected $table = 'itsupport'; 
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'jumlah', 'kondisi', 'keterangan'];

    public function getItsupport($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }
}
