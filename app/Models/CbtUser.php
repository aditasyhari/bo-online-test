<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtUser extends Model
{
    use HasFactory;
    protected $primaryKey = "user_id";
    protected $table = "cbt_user";
    protected $guarded = [];
    public $timestamps = false;

    public function scopeCheck($query, $email)
    {
        $sql = $query->where('user_email', $email);

        return $sql;
    }
}
