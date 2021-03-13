<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_user extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'staff_id',
        'staff_name',
        'staff_email',
        'staff_password',
        'staff_hp',
        'staff_alamat'    
    ];
}
