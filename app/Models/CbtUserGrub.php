<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CbtUserGrub extends Model
{
    use HasFactory;
    protected $primaryKey = "grup_id";
    protected $table = "cbt_user_grup";
    protected $guarded = [];
    public $timestamps = false;

    public function scopeDataChart($query)
    {
        $total = "(SELECT COUNT(*) FROM cbt_user cu WHERE cu.user_grup_id = cbt_user_grup.grup_id) as total";
        $sql = $query->select(DB::raw($total))->orderBy('grup_id', 'asc');

        return $sql;
    }
}
