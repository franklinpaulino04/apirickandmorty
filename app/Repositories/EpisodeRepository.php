<?php

namespace App\Repositories;

use App\Models\CharacterEpisode;
use App\Models\Episode;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class EpisodeRepository extends BaseRepository
{
    public function getFieldsSearchable()
    {
        return [];
    }

    public function model()
    {
        return Episode::class;
    }

    public function index()
    {
        $result = [
            'total'               => null,
            'last_page'           => null,
            'next_page_url'       => null,
            'prev_page_url'       => null,
            'data'                => [],
        ];

        $episodes                 = Episode::with(['characters'])->paginate(2)->toArray();


        foreach ($episodes['data'] as $row)
        {
            $characters           = $row['characters'] ? collect($row['characters'])->map(function($episode) {
                return route('character.show', $episode['character_id']);
            }) : [];

            $result['data'][] = [
                'id'              => $row['id'],
                'name'            => $row['name'],
                'air_date'        => $row['air_date'],
                'episode'         => $row['episode'],
                'characters'      => $characters,
                'url'             => route('episode.show', $row['id']),
                'created'         => $row['created_at'],
            ];
        }

        $result['total']          = $episodes['total'];
        $result['last_page']      = $episodes['last_page'];
        $result['next_page_url']  = $episodes['next_page_url'];
        $result['prev_page_url']  = $episodes['prev_page_url'];

        return $result;
    }

    public function show(Episode $episode)
    {
        $characters           = $episode->characters ? collect($episode->characters)->map(function($character) {
            return route('character.show', $character->character_id);
        }) : [];

        return [
            'id'              => $episode->id,
            'name'            => $episode->name,
            'air_date'        => $episode->air_date,
            'episode'         => $episode->episode,
            'characters'      => $characters,
            'url'             => route('episode.show', $episode->id),
            'created'         => $episode->created_at,
        ];
    }

    public function create($input)
    {
        try{
            $episode = Episode::create([
                'name'     => $input['name'],
                'air_date' => $input['air_date'],
                'episode'  => $input['episode'],
            ]);

            if(request()->has('characters'))
            {
                foreach(request('characters') as $character)
                {
                    CharacterEpisode::create([
                        'character_id'  => $character,
                        'episode_id'    => $episode->id,
                    ]);
                }
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $id)
    {
        try{

            $episode           = Episode::find($id);
            $episode->name     = $input['name'];
            $episode->air_date = $input['air_date'];
            $episode->episode  = $input['episode'];
            $episode->save();

            if(request()->has('characters'))
            {
                foreach(request('characters') as $character)
                {
                    CharacterEpisode::create([
                        'character_id'  => $character,
                        'episode_id'    => $episode->id,
                    ]);
                }
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
