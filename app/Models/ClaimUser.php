<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ClaimUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'claim_user';
    protected $guarded = [];
    public $timestamps = false;

    public function detailClaim()
    {
        return $this->hasMany(ClaimUserDetail::class, 'claim_id');
    }

    public function scopeUserClaim($query)
    {
        $sql = $query->where('status', 1);

        return $sql;
    }

    public function scopeTopClaim($query)
    {
        $total = "(COUNT(cu.user_id)) as total";
        $totalMoney = "(SUM(cu.total)) as total_money";
        $sql = $query->from('claim_user as cu')
                ->select(
                    'cu.user_id',
                    'u.user_firstname',
                    DB::raw("$total, $totalMoney")
                )
                ->leftJoin('cbt_user as u', 'u.user_id', '=', 'cu.user_id')
                ->where('cu.status', 1)
                ->groupBy('cu.user_id', 'u.user_firstname')
                ->orderBy('total_money', 'desc')
                ->limit(5);

        return $sql;
    }

}
