<?php

namespace App\Models;

use CodeIgniter\Model;

class LabsistemcerdasModel extends Model
{
  protected $table = 'labsistemcerdas';
  protected $primaryKey = 'id';

  protected $useTimestamps = true;
  protected $allowedFields = ['nama', 'jumlah', 'spesifikasi_lab', 'cctv', 'keterangan'];

  public function getLabsistemcerdas($id = false)
  {
    if ($id === false) {
      return $this->findAll();
    } else {
      return $this->getWhere(['id' => $id]);
    }
  }
}
