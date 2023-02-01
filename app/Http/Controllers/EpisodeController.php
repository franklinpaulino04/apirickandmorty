<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use App\Models\Episode;
use App\Repositories\EpisodeRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class EpisodeController extends AppBaseController
{
    private $episodeRepository;

    public function __construct(EpisodeRepository $episodeRepo)
    {
        $this->episodeRepository = $episodeRepo;
    }

    public function index()
    {
        try {
            return $this->sendInfo($this->episodeRepository->index());
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function store(EpisodeRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->episodeRepository->create($request->only((new Episode())->getFillable()));
            DB::commit();
            return $this->sendSuccess('episode saved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function show(Episode $episode)
    {
        try {
            return $this->sendResponse($this->episodeRepository->show($episode));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function update(EpisodeRequest $request, Episode $episode)
    {
        try {
            DB::beginTransaction();
            $this->episodeRepository->update($request->only((new Episode())->getFillable()), $episode->id);
            DB::commit();
            return $this->sendSuccess('episode updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function destroy(Episode $episode)
    {
        try {
            DB::beginTransaction();
            $this->episodeRepository->delete($episode->id);
            DB::commit();
            return $this->sendSuccess('episode deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
}
