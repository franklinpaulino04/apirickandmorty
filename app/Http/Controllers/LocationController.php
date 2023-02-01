<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class LocationController extends AppBaseController
{
    private $locationRepository;

    public function __construct(LocationRepository $locationRepo)
    {
        $this->locationRepository = $locationRepo;
    }

    public function index()
    {
        try {
            return $this->sendInfo($this->locationRepository->index());
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function store(LocationRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->locationRepository->create($request->only((new Location())->getFillable()));
            DB::commit();
            return $this->sendSuccess('location saved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function show(Location $location)
    {
        try {
            return $this->sendResponse($this->locationRepository->show($location));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function update(LocationRequest $request, Location $location)
    {
        try {
            DB::beginTransaction();
            $this->locationRepository->update($request->only((new Location())->getFillable()), $location->id);
            DB::commit();
            return $this->sendSuccess('location updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function destroy(Location $location)
    {
        try {
            DB::beginTransaction();
            $this->locationRepository->delete($location->id);
            DB::commit();
            return $this->sendSuccess('location deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
}
