<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "user_level";
    protected $guarded = [];
    public $timestamps = false;
}
