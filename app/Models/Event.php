<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model {
    protected $fillable = ['type', 'location', 'start_time', 'details'];

    const TYPE_GAME = 'game';
    const TYPE_PRACTICE = 'practice';

    const TYPE_DESCRIPTIONS = [
        self::TYPE_GAME => 'Game',
        self::TYPE_PRACTICE => 'Practice',
    ];

    public static function processDetails(Request $request): array {
        $details = [];

        $details['display_time'] = date('l, F jS, g:i A', strtotime($request->input('date') . ' ' . $request->input('time')));
        if ($request->input('type') === self::TYPE_GAME) {
            $home_team = Team::find($request->input('details.home'));
            $away_team = Team::find($request->input('details.away'));
            $details['home'] = $home_team->name;
            $details['home_id'] = $home_team->id;
            $details['away'] = $away_team->name;
            $details['away_id'] = $away_team->id;
        }

        return $details;
    }

    public function getDetailsAttribute($value): array {

        return json_decode($value ?: '', true) ?? [];
    }

    public function setDetailsAttribute($value): void {
        $this->attributes['details'] = json_encode($value ?: []);
    }
}
