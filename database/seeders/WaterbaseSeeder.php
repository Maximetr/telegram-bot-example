<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class WaterbaseSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(__DIR__.'/resource/waterbases.json');
        $data = json_decode($json, true);

        foreach ($data['data'] as $waterbase) {
            DB::table('waterbases')->insert([
                'uuid' => $waterbase['uuid'],
                'name' => $waterbase['name'],
                'region_uuid' => $waterbase['region_uuid']
            ]);
        }
    }
}
