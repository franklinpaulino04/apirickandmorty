<?php

namespace Database\Seeders;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::query()->truncate();
        Location::query()->insert([
            [
                "name"          => "Earth (C-137)",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Earth (Replacement Dimension)",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Citadel of Ricks",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Worldender's lair",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Anatomy Park",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Interdimensional Cable",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Immortality Field Resort",
                "type"          => 'Planet',
                "dimension"     => 'Dimension C-137',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
