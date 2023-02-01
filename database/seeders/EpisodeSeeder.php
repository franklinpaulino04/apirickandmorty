<?php

namespace Database\Seeders;

use App\Models\Episode;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Episode::query()->truncate();
        Episode::query()->insert([
            [
                "name"          => "Pilot",
                "air_date"      => "2013-12-02",
                "episode"       => "S01E01",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Lawnmower Dog",
                "air_date"      => "2013-12-09",
                "episode"       => "S01E02",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Anatomy Park",
                "air_date"      => "2013-12-16",
                "episode"       => "S01E03",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "M. Night Shaym-Aliens!",
                "air_date"      => "2014-01-13",
                "episode"       => "S01E04",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Meeseeks and Destroy",
                "air_date"      => "2014-01-20",
                "episode"       => "S01E05",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Rick Potion #9",
                "air_date"      => "2014-01-27",
                "episode"       => "S01E06",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Raising Gazorpazorp",
                "air_date"      => "2014-03-10",
                "episode"       => "S01E07",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Rixty Minutes",
                "air_date"      => "2014-03-17",
                "episode"       => "S01E08",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Something Ricked This Way Comes",
                "air_date"      => "2014-03-24",
                "episode"       => "S01E09",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Close Rick-counters of the Rick Kind",
                "air_date"      => "2014-04-07",
                "episode"       => "S01E10",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                "name"          => "Ricksy Business",
                "air_date"      => "2014-04-14",
                "episode"       => "S01E11",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
