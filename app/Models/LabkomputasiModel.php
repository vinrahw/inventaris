<?php

namespace App\Models;

use CodeIgniter\Model;

class LabkomputasiModel extends Model
{
  protected $table = 'labkomputasi';
  protected $primaryKey = 'id';

  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'jumlah', 'spesifikasi_lab', 'cctv', 'keterangan'];

  public function getLabkomputasi($id = false)
  {
    if ($id === false) {
      return $this->findAll();
    } else {
      return $this->getWhere(['id' => $id]);
    }
  }
}
