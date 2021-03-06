<?php

namespace App\Models;

use CodeIgniter\Model;

class LaboratoriumModel extends Model
{
  protected $table = 'laboratorium';
  protected $primaryKey = 'id';

  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'jumlah', 'spesifikasi_lab', 'cctv', 'keterangan'];

  public function getLaboratorium($id = false)
  {
    if ($id === false) {
      return $this->findAll();
    } else {
      return $this->getWhere(['id' => $id]);
    }
  }
}
