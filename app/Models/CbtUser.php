<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function scopeLatestUser($query, $limit)
    {
        $sql = $query->select(
                    'user_id',
                    'user_firstname',
                    'user_regdate',
                    'nama_sekolah',
                    'g.grup_nama'
                )
                ->leftJoin('cbt_user_grup as g', 'g.grup_id', '=', 'cbt_user.user_grup_id')
                ->orderBy('user_regdate', 'desc')
                ->limit($limit);

        return $sql;
    }
}
