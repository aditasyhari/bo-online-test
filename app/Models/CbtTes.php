<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtTes extends Model
{
    use HasFactory;
    protected $primaryKey = 'tes_id';
    protected $table = 'cbt_tes';
    protected $guarded = [];
    public $timestamps = false;

    public function scopeHasilTes($query, $tes_id, $urutkan)
    {		
        switch($urutkan) {
            case 'nama':
                $key = 'user_firstname';
                $val = 'ASC';
                break;
            case 'tertinggi':
                $key = 'nilai';
                $val = 'DESC';
                break;
            case 'terendah':
                $key = 'nilai';
                $val = 'ASC';
                break;
            default:
                $key = 'nilai';
                $val = 'DESC';
                break;
        }

        $nilai = "(SUM(cbt_tes_soal.tessoal_nilai)) AS nilai";

		$sql = $query->select(
                    'cbt_tes_user.*',
                    'cbt_tes.tes_nama',
                    'cbt_user.user_firstname',
                    'cbt_user.nama_sekolah',
                    'cbt_user_grup.grup_nama', 
                    'kotakab', 
                    'nama_propinsi', 
                    DB::raw($nilai)
                )
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id', '=', 'cbt_user.user_id')
                 ->join('tm_kotakab', 'tm_kotakab.id_kotakab', '=', 'cbt_user.id_kotakab')
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id', '=', 'cbt_tes.tes_id')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id', '=', 'cbt_tes_user.tesuser_id')
                 ->join('tm_propinsi', 'tm_propinsi.id_propinsi', '=', 'cbt_user.id_propinsi')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
                 ->where('tes_id', $tes_id)
                 ->groupBy('cbt_tes_user.tesuser_id')
				 ->orderBy($key, $val)
                 ->get();

        return $sql;
	}
}
