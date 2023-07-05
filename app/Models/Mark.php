<?php 
namespace App\Models;

use CodeIgniter\Model;

class Mark extends Model
{
    protected $table            = 'mark';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['nama', 'jabatan', 'bidang', 'alamat', 'email' , 'upload'   ];

    // Dates
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
