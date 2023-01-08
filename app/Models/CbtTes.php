<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CbtTes extends Model
{
    use HasFactory;
    protected $primaryKey = 'tes_id';
    protected $table = 'cbt_tes';
    protected $guarded = [];
    public $timestamps = false;

    public function list($grub_id)
    {
        $sql = DB::table('cbt_tes as t')
                ->select('t.tes_id', 't.tes_nama', 'tg.tstgrp_grup_id as grup_id')
                ->leftJoin('cbt_tesgrup as tg', 'tg.tstgrp_tes_id', '=', 't.tes_id')
                ->where('aktif', 1)
                ->when($grub_id, fn ($sql, $grub_id) => $sql->where('tg.tstgrp_grup_id', $grub_id))
                ->orderBy('t.tes_id', 'desc')
                ->get();

        return $sql;
    }
}
