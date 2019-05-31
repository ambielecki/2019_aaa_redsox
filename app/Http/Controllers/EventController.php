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
        $search = $request->get('search');
        $page = $request->get('page') ?: 1;
        $limit = $request->get('limit') ?: 20;
        $skip = ($page - 1) * $limit;

        $query = BlogPage::query()
            ->where('is_active', 1)
            ->orderBy('id', 'DESC');

        if ($search) {
            $search = '%' . $search . '%';
            $query = $query->where('title', 'LIKE', $search);
        }

        $count = $query->count();

        $posts = $query
            ->limit($limit)
            ->skip($skip)
            ->get();

        $posts = $posts->map(function ($post) {
            return BlogPage::processContent($post);
        });

        return response()->json([]);
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
            'details' => $request->input('details'),
        ])) {
            Session::flash('flash_success', 'Event created successfully');

            return redirect()->route('home');
        }

        Session::flash('flash_error', 'There was a problem saving your event');

        return back()->withInput();
    }

    public function getAdminEdit($id): View {
        return view();
    }

    public function postAdminEdit(EventRequest $request, $id): RedirectResponse {
        return back()->withInput();
    }
}
