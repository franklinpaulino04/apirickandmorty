<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\LocationResident;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class LocationRepository extends BaseRepository
{
    public function getFieldsSearchable()
    {
        return [];
    }

    public function model()
    {
        return Location::class;
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

        $locations                = Location::with(['residents'])->paginate(2)->toArray();


        foreach ($locations['data'] as $row)
        {
            $residents            = $row['residents'] ? collect($row['residents'])->map(function($episode) {
                return route('character.show', $episode['character_id']);
            }) : [];

            $result['data'][] = [
                'id'              => $row['id'],
                'name'            => $row['name'],
                'type'            => $row['type'],
                'dimension'       => $row['dimension'],
                'residents'       => $residents,
                'url'             => route('location.show', $row['id']),
                'created'         => $row['created_at'],
            ];
        }

        $result['total']          = $locations['total'];
        $result['last_page']      = $locations['last_page'];
        $result['next_page_url']  = $locations['next_page_url'];
        $result['prev_page_url']  = $locations['prev_page_url'];

        return $result;
    }

    public function show(Location $location)
    {
        $residents            = $location->residents ? collect($location->residents)->map(function($episode) {
            return route('character.show', $episode['character_id']);
        }) : [];

        return [
            'id'              => $location->id,
            'name'            => $location->name,
            'type'            => $location->type,
            'dimension'       => $location->dimension,
            'residents'       => $residents,
            'url'             => route('location.show', $location->id),
            'created'         => $location->created_at,
        ];
    }

    public function create($input)
    {
        try{

            $location = Location::create([
                'name'                  => $input['name'],
                'type'                  => $input['type'],
                'dimension'             => $input['dimension'],
            ]);

            if(request()->has('residents'))
            {
                foreach(request('residents') as $resident)
                {
                    LocationResident::create([
                        'location_id'   => $location->id,
                        'character_id'  => $resident,
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
            $location                   = Location::find($id);
            $location->name             = $input['name'];
            $location->type             = $input['type'];
            $location->dimension        = $input['dimension'];
            $location->save();

            if(request()->has('residents'))
            {
                foreach(request('residents') as $resident)
                {
                    LocationResident::create([
                        'location_id'   => $location->id,
                        'character_id'  => $resident,
                    ]);
                }
            }

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
