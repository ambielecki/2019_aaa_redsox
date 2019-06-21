<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

class EventController extends Controller {
    public function getView($id): View {
        return view('main.event.view');
    }

    public function getList(): View {
        return view('main.event.list');
    }

    public function getApiList(Request $request): JsonResponse {
        $days = $request->get('days');

        $query = Event::query()
            ->orderBy('start_time', 'ASC');

        if ($days) {
            $query = $query
                ->where([
                    ['start_time', '>=', date('Y-m-d', strtotime('today'))],
                    ['start_time', '<=', date('Y-m-d', strtotime('+7 days'))],
                ]);
        }

        $count = $query->count();
        $events = $query->get();

        $events = $events->map(function ($event) {
            $event->display_time = date('l, F jS, g:i A', strtotime($event->start_time));
            return $event;
        });

        return response()->json([
            'events' => $events,
            'count' => $count,
        ]);
    }

    public function getAdminList(): View {
        return view('admin.event.list');
    }

    public function getAdminCreate(): View {
        $event = new Event();

        return view('admin.event.create', [
            'event' => $event,
        ]);
    }

    public function postAdminCreate(EventRequest $request): RedirectResponse
    {
        if (Event::create([
            'type' => $request->input('type'),
            'location' => $request->input('location'),
            'start_time' => date('Y-m-d H:i', strtotime($request->input('date') . ' ' . $request->input('time'))),
            'details' => Event::processDetails($request),
        ])) {
            Session::flash('flash_success', 'Event created successfully');

            return redirect()->route('home');
        }

        Session::flash('flash_error', 'There was a problem saving your event');

        return back()->withInput();
    }

    public function getAdminEdit($id): View {
        $event = Event::find($id);

        return view('admin.event.edit', [
            'event' => $event,
        ]);
    }

    public function postAdminEdit(EventRequest $request, $id): RedirectResponse {
        return back()->withInput();
    }
}
