<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Repositories\CharacterRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CharacterController extends AppBaseController
{
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepo)
    {
        $this->characterRepository = $characterRepo;
    }

    public function index()
    {
        try {
            return $this->sendInfo($this->characterRepository->index());
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function store(CharacterRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->characterRepository->create($request->only((new Character())->getFillable()));
            DB::commit();
            return $this->sendSuccess('character saved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function show(Character $character)
    {
        try {
            return $this->sendResponse($this->characterRepository->show($character));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function update(CharacterRequest $request, Character $character)
    {
        try {
            DB::beginTransaction();
            $this->characterRepository->update($request->only((new Character())->getFillable()), $character->id);
            DB::commit();
            return $this->sendSuccess('character updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function destroy(Character $character)
    {
        try {
            DB::beginTransaction();
            $this->characterRepository->delete($character->id);
            DB::commit();
            return $this->sendSuccess('character deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
}
