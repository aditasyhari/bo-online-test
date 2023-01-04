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
}
