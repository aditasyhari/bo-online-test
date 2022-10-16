<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path_propinsi = public_path('sql/tm_propinsi.sql');
        $sql_propinsi = file_get_contents($path_propinsi);
        DB::unprepared($sql_propinsi);

        $path_kotakab = public_path('sql/tm_kotakab.sql');
        $sql_kotakab = file_get_contents($path_kotakab);
        DB::unprepared($sql_kotakab);

        $path_kecamatan = public_path('sql/tm_kecamatan.sql');
        $sql_kecamatan = file_get_contents($path_kecamatan);
        DB::unprepared($sql_kecamatan);

        // $path_kelurahan = public_path('sql/tm_kelurahan.sql');
        // $sql_kelurahan = file_get_contents($path_kelurahan);
        // DB::unprepared($sql_kelurahan);
    }
}
