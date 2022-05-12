<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class VolumeSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(__DIR__.'/resource/volumes.json');
        $data = json_decode($json, true);

        foreach ($data['data'] as $volume) {
            DB::table('volumes')->insert([
                'volume' => $volume['volume'],
                'waterbase_uuid' => $volume['waterbase_uuid'],
            ]);
        }
    }
}
