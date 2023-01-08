<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtUserGrub extends Model
{
    use HasFactory;
    protected $primaryKey = "grup_id";
    protected $table = "cbt_user_grup";
    protected $guarded = [];
    public $timestamps = false;
}
