<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller {
    public function getApiList(Request $request): JsonResponse {
        $query = Team::query()
            ->with('division')
            ->orderBy('name', 'ASC');

        $division_id = $request->input('division_id');

        if ($division_id) {
            $query = $query->where('division_id', $division_id);
        }

        return response()->json([
            'teams' => $query->get(),
        ]);
    }
}
