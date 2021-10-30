<?php

namespace App\Models;

use CodeIgniter\Model;

class LabsiskomdaModel extends Model
{
    protected $table = 'labsiskomda';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'jumlah', 'keterangan'];

    public function getLabsiskomda($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
    }
}
