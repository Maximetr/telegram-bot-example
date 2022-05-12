<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class RegionsSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(__DIR__.'/resource/regions.json');
        $data = json_decode($json, true);

        foreach ($data['data'] as $region) {
            DB::table('regions')->insert([
                'uuid' => $region['uuid'],
                'name' => $region['name'],
                'area_names' => implode(',', $region['area_names'])
            ]);
        }
    }
}
