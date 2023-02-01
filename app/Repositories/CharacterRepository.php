<?php

namespace App\Repositories;

use App\Models\Character;
use App\Models\CharacterEpisode;
use App\Models\Location;
use App\Models\LocationResident;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CharacterRepository extends BaseRepository
{
    public function getFieldsSearchable()
    {
        return [];
    }

    public function model()
    {
        return Character::class;
    }

    public function index()
    {
        $result = [
            'total'             => null,
            'last_page'         => null,
            'next_page_url'     => null,
            'prev_page_url'     => null,
            'data'              => [],
        ];

        $characters             = Character::with(['episode'])->paginate(2)->toArray();

        foreach ($characters['data'] as $row)
        {

            $origin             = Location::find($row['origin_id']);
            $location           = Location::find($row['location_id']);
            $episodes           = $row['episode'] ? collect($row['episode'])->map(function($episode) {
                return route('episode.show', $episode['episode_id']);
            }) : [];

            $result['data'][] = [
                'id'            => $row['id'],
                'name'          => $row['name'],
                'status'        => $row['status'],
                'species'       => $row['species'],
                'type'          => $row['type'],
                'gender'        => $row['gender'],
                'origin'  => [
                    'name'      => ($origin)? $origin->name : 'unknown',
                    'url'       => $origin ? route('location.show', $origin->id) : '',
                ],
                'location'  => [
                    'name'      => $location ? $location->name : 'unknown',
                    'url'       => $location ? route('location.show', $location->id) : '',
                ],
                'image'         => $row['image'],
                'episode'       => $episodes,
                'url'           => route('character.show', $row['id']),
                'created'       => $row['created_at'],
            ];
        }


        $result['total']          = $characters['total'];
        $result['last_page']      = $characters['last_page'];
        $result['next_page_url']  = $characters['next_page_url'];
        $result['prev_page_url']  = $characters['prev_page_url'];

        return $result;
    }

    public function show(Character $character)
    {
        $origin             = Location::find($character->origin_id);
        $location           = Location::find($character->location_id);
        $episodes           = $character->episode ? collect($character->episode)->map(function($episode) {
            return route('episode.show', $episode->episode_id);
        }) : [];

        return [
            'id'            => $character->id,
            'name'          => $character->name,
            'status'        => $character->status,
            'species'       => $character->species,
            'type'          => $character->type,
            'gender'        => $character->gender,
            'origin'  => [
                'name'      => ($origin)? $origin->name : 'unknown',
                'url'       => $origin ? route('location.show', $origin->id) : '',
            ],
            'location'  => [
                'name'      => $location ? $location->name : 'unknown',
                'url'       => $location ? route('location.show', $location->id) : '',
            ],
            'image'         => $character->image,
            'episode'       => $episodes,
            'url'           => route('character.show', $character->id),
            'created'       => $character->created_at,
        ];
    }

    public function create($input)
    {
        try {
            $character                  = Character::create([
                'name'                  => $input['name'],
                'status'                => $input['status'],
                'species'               => $input['species'],
                'type'                  => $input['type'],
                'gender'                => $input['gender'],
                'origin_id'             => request('origin'),
                'location_id'           => request('location'),
            ]);

            if(request()->has('location'))
            {
                LocationResident::create([
                    'location_id'       => request('location'),
                    'character_id'      => $character->id,
                ]);
            }

            if(request()->has('episode'))
            {
                foreach(request('episode') as $episode)
                {
                    CharacterEpisode::create([
                        'character_id'  => $character->id,
                        'episode_id'    => $episode,
                    ]);
                }
            }

            if ($file = request()->file('image'))
            {
                $name = $character->id.'-'.time().rand(1, 100).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('characters/'), $name);

                $character->image = $name;
                $character->save();
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $id)
    {
        try {
            $character                    = Character::find($id);
            $character->name              = $input['name'];
            $character->status            = $input['status'];
            $character->species           = $input['species'];
            $character->type              = $input['type'];
            $character->gender            = $input['gender'];
            $character->origin_id         = request('origin');
            $character->location_id       = request('location');
            $character->save();

            if(request()->has('location'))
            {
                LocationResident::create([
                    'location_id'         => request('location'),
                    'character_id'        => $character->id,
                ]);
            }

            if(request()->has('episode'))
            {
                foreach(request('episode') as $episode)
                {
                    CharacterEpisode::create([
                        'character_id'    => $character->id,
                        'episode_id'      => $episode,
                    ]);
                }
            }

            if ($file = request()->file('image'))
            {
                $name = $character->id.'-'.time().rand(1, 100).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('characters/'), $name);

                $character->image = $name;
                $character->save();
            }

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
