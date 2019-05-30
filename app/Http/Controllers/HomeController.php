<?php

namespace App\Http\Controllers;

use App\Models\Pages\BlogPage;
use App\Models\Pages\HomePage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

class HomeController extends Controller {
    public function getHome(): View {
        $page = HomePage::where([
            ['is_active', true],
        ])
            ->orderBy('revision', 'DESC')
            ->first();

        $max_blog_posts = (int) ($page->content['blog_posts'] ?? 0);

        $blog_posts = BlogPage::query()
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->limit($max_blog_posts)
            ->get();

        dd($blog_posts->toArray());

        $content = $page->content ?? [];
        unset($page['content']);

        return view('main.home.home', [
            'page'    => $page,
            'content' => $content,
            'blog_posts' => $blog_posts,
        ]);
    }

    // this is restricted to admins in web.php
    public function getEdit($id = null): View {
        if ($id) {
            $current_page = HomePage::find($id);

            $is_current = $current_page->revision === HomePage::where('is_active', 1)->max('revision');
        } else {
            $current_page = HomePage::query()
                ->where([
                    ['is_active', 1],
                ])
                ->orderBy('revision', 'DESC')
                ->first();

            $is_current = true;
        }

        $current_page = $current_page ?? new HomePage();

        return view('admin.home.home', [
            'current_page' => $current_page,
            'content'      => $current_page->content ?? [],
            'is_current'   => $is_current,
        ]);
    }

    public function postEdit(Request $request) {
        $last_page = HomePage::query()
            ->orderBy('id', 'DESC')
            ->first();

        $page = new HomePage();
        $page->revision = $last_page ? $last_page->revision + 1 : 1;
        $page->is_active = $request->input('save_as_active') ? 1 : 0;
        $page->content = $request->input('content');
        $page->title = $request->input('title');
        if ($last_page) {
          $page->parent_id = $last_page->parent_id ?? $last_page->id;
        }

        if ($page->save()) {
            if ($request->input('save_as_active')) {
              if ($last_page) {
                HomePage::query()
                  ->where('slug', $last_page->slug)
                  ->where('id', '<>', $page->id)
                  ->update(['is_active' => 0]);
              }
            }

            Session::flash('flash_success', 'Home Page Saved');
        } else {
            Session::flash('flash_error', 'Error Saving Home Page');
        }

        return redirect()->route('admin_home_edit');
    }

    public function getApiList(Request $request): JsonResponse {
        $page = $request->get('page') ?: 1;
        $limit = $request->input('limit') ?: 10;
        $skip = ($page - 1) * $limit;

        $query = HomePage::query()
            ->where('is_active', 0)
            ->orderBy('revision', 'DESC');

        $count = $query->count();

        $posts = $query
            ->limit($limit)
            ->skip($skip)
            ->get()
            ->toArray();

        return response()->json([
            'posts' => $posts,
            'page'   => (int) $page,
            'pages'  => ceil($count / $limit),
            'count'  => $count,
        ]);
    }
}
