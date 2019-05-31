<?php

namespace App\Http\Controllers;

use App\Helpers\CommandUtility;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageEditRequest;
use App\Models\Image;
use App\Models\Tag;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

class ImageController extends Controller {
    // Admin Functionality
    public function getAdminList(): View {
        return view('admin.images.list');
    }

    public function getAdminCreate(): View {
        $image = new Image();
        $tags = Tag::query()
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.images.create', [
            'image'     => $image,
            'image_tag' => [],
            'tags'      => $tags,
        ]);
    }

    public function postAdminCreate(ImageCreateRequest $request): RedirectResponse {
        $id = Image::createImage($request);
        if ($id !== 0) {
            $image = Image::find($id);

            if ($request->input('new_tags')) {
                $new_tag_ids = Tag::createNewTags($request->input('new_tags'));
            } else {
                $new_tag_ids = [];
            }

            $existing_tags = $request->input('tags') ?: [];
            $tags = array_unique(array_merge($existing_tags, $new_tag_ids));
            $image->tags()->attach($tags);

            CommandUtility::runBackgroundCommand("php artisan baseball:resize_image --id=$image->id");

            Session::flash('flash_success', 'Image Uploaded Successfully');

            return redirect()->route('admin_image_list');
        }

        Session::flash('flash_warning', 'There was a problem saving your image, please try again');
        return redirect()->back()->withInput();
    }

    public function getAdminEdit($id): View {
        $image = Image::find($id);
        $tags = Tag::query()
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $image_tags = DB::table('image_tag')
            ->where('image_id', $id)
            ->pluck('image_id', 'tag_id');

        return view('admin.images.edit', [
            'image'      => $image,
            'image_tags' => $image_tags,
            'tags'       => $tags,
        ]);
    }

    public function postAdminEdit(ImageEditRequest $request, $id): RedirectResponse {
        $image = Image::find($id);
        $image->title = $request->input('title');
        $image->description = $request->input('description');
        $image->is_hero = $request->input('is_hero') ? 1 : 0;

        if ($image->save()) {
            if ($request->input('new_tags')) {
                $new_tag_ids = Tag::createNewTags($request->input('new_tags'));
            } else {
                $new_tag_ids = [];
            }

            $existing_tags = $request->input('tags') ?: [];
            $tags = array_unique(array_merge($existing_tags, $new_tag_ids));
            $image->tags()->sync($tags);

            Session::flash('flash_success', 'Image Updated Successfully');

            return redirect(route('admin_image_edit', ['ids' => $id]));
        }

        Session::flash('flash_warning', 'There was a problem updating your image, please try again');

        return redirect()->back()->withInput();
    }

    public function getAdminApiList(Request $request): JsonResponse {
        $search = $request->get('search');
        $page = $request->get('page') ?: 1;
        $limit = $request->get('limit') ?: 20;
        $skip = ($page - 1) * $limit;

        $query = Image::query()
            ->with('tags')
            ->orderBy('id', 'DESC');

        if ($request->get('is_hero')) {
            $query = $query->where('is_hero', $request->get('is_hero') === 'true' ? 1 : 0);
        }

        if ($search) {
            $search = '%' . $search . '%';
            $query = $query->where('title', 'LIKE', $search)
                ->orWhereHas('tags', function ($query) use ($search) {
                    $query->where('name', 'LIKE', $search);
                });
        }

        $count = $query->count();

        $images = $query
            ->limit($limit)
            ->skip($skip)
            ->get();

        return response()->json([
            'images' => $images,
            'page'   => (int) $page,
            'pages'  => ceil($count / $limit),
            'count'  => $count,
        ]);
    }

    public function getAdminApiDetail(): JsonResponse {
        return response()->json([]);
    }
}
