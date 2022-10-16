<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAkses extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "user_akses";
    protected $guarded = [];
    public $timestamps = false;
}
