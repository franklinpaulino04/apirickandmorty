<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\CharacterEpisode;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::query()->truncate();
        $characters = [
            [
                "name"          => "Rick Sanchez",
                "status"        => 'Alive',
                "species"       => 'Human',
                'type'          => '',
                'gender'        => 'Male',
                'origin_id'     => 1,
                'location_id'   => 3,
                'image'         => '1.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Morty Smith",
                "status"        => 'Dead',
                "species"       => 'Human',
                'type'          => '',
                'gender'        => 'Male',
                'origin_id'     => 1,
                'location_id'   => 3,
                'image'         => '2.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Summer Smith",
                "status"        => 'unknown',
                "species"       => 'Human',
                'type'          => '',
                'gender'        => 'Female',
                'origin_id'     => 1,
                'location_id'   => 4,
                'image'         => '3.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Beth Smith",
                "status"        => 'unknown',
                "species"       => 'Human',
                'type'          => '',
                'gender'        => 'Female',
                'origin_id'     => 1,
                'location_id'   => 8,
                'image'         => '4.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Jerry Smith",
                "status"        => 'Dead',
                "species"       => 'Human',
                'type'          => '',
                'gender'        => 'Male',
                'origin_id'     => 1,
                'location_id'   => 6,
                'image'         => '5.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Abadango Cluster Princess",
                "status"        => 'Dead',
                "species"       => 'Human',
                'type'          => '',
                'gender'        => 'Female',
                'origin_id'     => 2,
                'location_id'   => 2,
                'image'         => '6.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Abradolf Lincler",
                "status"        => 'Dead',
                "species"       => 'Human',
                'type'          => 'Genetic experiment',
                'gender'        => 'Male',
                'origin_id'     => 2,
                'location_id'   => 4,
                'image'         => '7.jpeg',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        CharacterEpisode::query()->truncate();

        $count = 1;
        foreach ($characters as $row)
        {
            $character = Character::create($row);

           for ($i = 1; $i <= $count; $i++)
           {
               CharacterEpisode::create([
                   'character_id' => $character->id,
                   'episode_id'   => $i,
               ]);
           }

            $count++;
        }
    }
}
