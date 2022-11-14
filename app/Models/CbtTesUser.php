<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtTesUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'tesuser_id';
    protected $table = 'cbt_tes_user';
    protected $guarded = [];
    public $timestamps = false;

    public function scopeGetUserTest($query, $grub)
    {
        $today = date("Y-m-d");
        $sql = $query->select(
                    'cbt_user_grup.grup_nama',
                    'cbt_user.user_email',
                    'cbt_tes_user.tesuser_id',
                )
                ->join('cbt_user', 'cbt_tes_user.tesuser_user_id', '=', 'cbt_user.user_id')
                ->join('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
                ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id', '=', 'cbt_tes.tes_id')
                ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id', '=', 'cbt_tes_user.tesuser_id')
                ->where('cbt_user_grup.grup_nama', $grub)
                ->whereRaw('DATE_ADD(cbt_tes.tes_end_time, INTERVAL 3 DAY) >= ?', [$today])
                ->groupBy('cbt_tes_user.tesuser_id')
                ->pluck('cbt_user.user_email');

        return $sql;
    }
}
