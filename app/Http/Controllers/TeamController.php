<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller {
    public function getApiList(Request $request): JsonResponse {
        $query = Team::query()
            ->orderBy('name', 'ASC');

        return response()->json([
            'teams' => $query->get(),
        ]);
    }
}
