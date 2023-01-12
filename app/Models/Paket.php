<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Paket extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tm_paket';
    protected $guarded = [];
    public $timestamps = false;

    public function scopeDataChart($query)
    {
        $total = "(SELECT COUNT(*) FROM claim_user_detail cud left join claim_user cu ON cu.id = cud.claim_id WHERE cu.status = 1 AND cud.paket = tm_paket.nama_paket) as total";
        $sql = $query->select(DB::raw($total));

        return $sql;
    }
}
