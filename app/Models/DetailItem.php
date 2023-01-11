<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class DetailItem extends Model
{
    use HasFactory;
    protected $primaryKey = "detail_items_id";
    protected $table = "detail_items";
    protected $guarded = [];
    public $timestamps = false;

    public function listTerdaftar($options)
    {
        $tes_id = $options['tes_id'];
        $grub_id = $options['grub_id'];

        $sql = DB::table('detail_items as di')
                ->select(
                    'di.order_id',
                    'di.item_id',
                    'di.user_id',
                    'ct.tes_nama',
                    'u.user_firstname',
                    'u.user_email',
                    'ug.grup_nama',
                    'u.nama_sekolah',
                )
                ->leftJoin('cbt_user as u', 'u.user_id', '=', 'di.user_id')
                ->leftJoin('transaksi as t', 't.order_id', '=', 'di.order_id')
                ->leftJoin('cbt_tes as ct', 'ct.tes_id', '=', 'di.item_id')
                ->leftJoin('cbt_user_grup as ug', 'ug.grup_id', '=', 'u.user_grup_id')
                ->where('t.transaction_status', 'settlement')
                ->when($tes_id, fn ($sql, $tes_id) => $sql->where('di.item_id', $tes_id))
                ->when($grub_id, fn ($sql, $grub_id) => $sql->where('u.user_grup_id', $grub_id))
                ->orderBy('di.detail_items_id', 'desc')
                ->get();

        return $sql;
    }
}
