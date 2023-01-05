<?php

namespace App\Exports;

use App\Models\CbtTesUser;
use App\Models\UserLevel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class ExportHasilTes implements FromCollection, WithHeadings, ShouldAutoSize
{
    // use Exportable;

    protected $tes_id;
    protected $order;

    function __construct($tes_id, $order) {
        $this->tes_id = $tes_id;
        $this->order = $order;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'OLIMPIADE',
            'NAMA LENGKAP',
            'NO. HP',
            'SEKOLAH',
            'GRUB',
            'KOTA/KAB',
            'PROVINSI',
            'NILAI',
            'MEDALI',
            'PREDIKAT'
        ];
    }

    public function collection()
    {
        switch($this->order) {
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

        $nilai = "(FLOOR(SUM(cbt_tes_soal.tessoal_nilai))) AS nilai";
        $nilai_raw = "FLOOR(SUM(cbt_tes_soal.tessoal_nilai))";
        $medali = "(
            CASE
                WHEN $nilai_raw > 279 THEN 'Peraih Medali Emas Nasional'
                WHEN $nilai_raw > 199 THEN 'Peraih Medali Perak Nasional'
                WHEN $nilai_raw > 49 THEN 'Peraih Medali Perunggu Nasional'
                ELSE 'Peserta'
            END
        ) AS 'medali'";
        $grade = "(
            CASE
                WHEN $nilai_raw > 279 THEN 'A+'
                WHEN $nilai_raw > 199 THEN 'A'
                WHEN $nilai_raw > 49 THEN 'B+'
                ELSE 'B'
            END
        ) AS 'predikat'";

		$sql = DB::table('cbt_tes_user')->select(
                    'cbt_tes.tes_nama',
                    'cbt_user.user_firstname',
                    DB::raw("IFNULL(cbt_user.nomor_hp, '-')"),
                    'cbt_user.nama_sekolah',
                    'cbt_user_grup.grup_nama', 
                    'kotakab', 
                    'nama_propinsi', 
                    DB::raw($nilai),
                    DB::raw($medali),
                    DB::raw($grade)
                )
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id', '=', 'cbt_user.user_id')
                 ->join('tm_kotakab', 'tm_kotakab.id_kotakab', '=', 'cbt_user.id_kotakab')
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id', '=', 'cbt_tes.tes_id')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id', '=', 'cbt_tes_user.tesuser_id')
                 ->join('tm_propinsi', 'tm_propinsi.id_propinsi', '=', 'cbt_user.id_propinsi')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
                 ->where('cbt_tes_user.tesuser_tes_id', $this->tes_id)
                 ->groupBy('cbt_tes_user.tesuser_id', 'cbt_tes.tes_nama', 'cbt_user.user_firstname', 'cbt_user.nomor_hp', 'cbt_user.nama_sekolah', 'cbt_user_grup.grup_nama', 'kotakab', 'nama_propinsi')
				 ->orderBy($key, $val)
                 ->get();

        return collect($sql);
    }

}
