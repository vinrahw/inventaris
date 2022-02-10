<?php

namespace App\Models;

use CodeIgniter\Model;

class LabalgoprogModel extends Model
{
  protected $table = 'labalgoprog';
  protected $primaryKey = 'id';

  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'jumlah', 'spesifikasi_lab', 'cctv', 'keterangan'];

  public function getLabalgoprog($id = false)
  {
    if ($id === false) {
      return $this->findAll();
    } else {
      return $this->getWhere(['id' => $id]);
    }
  }
}
