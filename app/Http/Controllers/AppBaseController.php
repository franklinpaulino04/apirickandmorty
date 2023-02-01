<?php

namespace App\Http\Controllers;

class AppBaseController extends Controller
{
    public function sendInfo($data, $status = 200)
    {
        return response()->json([
            'info' => [
                "count" => $data['total'] ?? null,
                "pages" => $data['last_page'] ?? null,
                "next"  => $data['next_page_url'] ?? null,
                "prev"  => $data['prev_page_url'] ?? null,
            ],
            'results' => $data['data'] ?? [],
        ], $status);
    }

    public function sendSuccess($message, $data = [], $status = 200)
    {
        return response()->json(array_merge([
            'success' => true,
            'message' => $message,
        ], $data), $status);
    }

    public function sendError($message, $data = [], $status = 401)
    {
        return response()->json(array_merge([
            'success' => false,
            'message' => $message,
        ], $data), $status);
    }

    public function sendResponse($data = [])
    {
        return response()->json($data);
    }
}
