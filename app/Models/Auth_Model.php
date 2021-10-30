<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth_Model extends Model
{
  protected $table = 'user';
  protected $allowedFields = ['username', 'password', 'role'];
}
