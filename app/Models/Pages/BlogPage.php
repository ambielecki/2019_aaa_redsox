<?php

namespace App\Models\Pages;

use App\Http\Requests\BlogRequest;
use App\Models\Image;
use App\Models\Page;
use App\Scopes\BlogPageScope;

class BlogPage extends Page {
    const PAGE_TYPE = 'blog';

    const IMAGE_REGEX = '/\|\|--(.*?)--\|\|/';
    const IMAGE_INSERT_REGEX = '/\<p\>\|\|-- (.*?) --\|\|\<\/p\>/';
    const IMAGAE_TEMPLATE = <<<IMAGE
<div class="row">
    <div class="col s6 offset-s3">
        <img class="responsive-img" src="%s" title="%s" alt="%s">
    </div>
</div>
IMAGE;


    protected static function boot(): void {
        parent::boot();

        static::addGlobalScope(new BlogPageScope());

        static::creating(function ($query) {
            $query->page_type = self::PAGE_TYPE;
        });
    }

    public function getContentAttribute($value): array {
        $content = json_decode($value, true);

//        if (isset($content['hero_image'])) {
//            $hero_image = Image::find($content['hero_image']['id']);
//            $hero_image = $hero_image ? $hero_image->toArray() : [];
//
//            $content['hero_image'] = array_merge($hero_image, $content['hero_image']);
//        }
//
//        if (isset($content['carousel_images']['ids'])) {
//            $ids = explode(',', $content['carousel_images']['ids']);
//            $carousel_images = Image::query()
//                ->whereIn('id', $ids)
//                ->get()
//                ->toArray();
//
//            $content['carousel_images']['images'] = $carousel_images;
//        }

        return $content;
    }

    public static function getSlug(string $title): string {
        $slug = strtolower($title);
        $slug = str_replace("'", '', $slug);
        $slug = preg_replace('~[^\\pL0-9_]+~u', '-', $slug);
        $slug = preg_replace('~[^-a-z0-9_]+~', '', $slug);

        return $slug . date('-Y-m-d');
    }

    public static function checkSlug(string $slug): bool {
        return self::where('slug', $slug)->count() === 0;
    }

    public static function getImageIds($content): array {
        $regex = self::IMAGE_REGEX;
        preg_match_all($regex, $content, $matches);

        if ($matches) {
            $ids = array_map('trim', $matches[1]);
        } else {
            $ids = [];
        }

        return $ids;
    }

    public static function processPost(BlogPage $post, BlogRequest $request, string $slug, BlogPage $original_page = null): BlogPage {
        $ids = BlogPage::getImageIds($request->input('content.content'));

        $content = $request->input('content');
        $content['image_ids'] = $ids;

        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->content = $content;
        $post->is_active = $request->input('is_active') ?: 0;
        $post->revision = $original_page ? $original_page->revision + 1 : 1;
        if ($original_page) {
            $post->parent_id = $original_page->parent_id ?? $original_page->id;
        }

        return $post;
    }

    public static function processContent(BlogPage $post): BlogPage {
        $post_content = $post->content;
        $content = $post_content['content'] ?: '';

        preg_match_all(self::IMAGE_INSERT_REGEX, $content, $matches);

        if ($matches) {
            $images = Image::find($matches[1]) ?? [];

            if ($images) {
                $images = $images->keyBy('id')->all();
            }

            foreach ($matches[0] as $key => $match) {
                $image_id = $matches[1][$key];
                $replacement_image = $images[$image_id];
                $src = $replacement_image->has_sizes
                    ? '/' . $replacement_image->folder . 'medium/' . $replacement_image->file_name
                    : '/' . $replacement_image->folder . $replacement_image->file_name;

                $replacement = sprintf(self::IMAGAE_TEMPLATE, $src, $replacement_image->title, $replacement_image->description);

                $content = str_replace($match, $replacement, $content);
            }
        }

        $post_content['content'] = $content;

        $post->content = $post_content;

        return $post;
    }
}