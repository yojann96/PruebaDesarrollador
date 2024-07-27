<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table = 'dbo.tbl_users';
    protected $primaryKey = 'ID_Usuario';
    public $timestamps = false;
}
