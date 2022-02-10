<?php

namespace App\Models;

use CodeIgniter\Model;

class LabrplModel extends Model
{
  protected $table = 'labrpl';
  protected $primaryKey = 'id';

  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'jumlah', 'spesifikasi_lab', 'cctv', 'keterangan'];

  public function getLabrpl($id = false)
  {
    if ($id === false) {
      return $this->findAll();
    } else {
      return $this->getWhere(['id' => $id]);
    }
  }
}
