<?php

namespace App\Models\Pages;

use App\Models\Image;
use App\Models\Page;

class HomePage extends Page {
    const PAGE_TYPE = 'home';

    public function getContentAttribute($value): array {
        $content = json_decode($value, true);

        if (isset($content['hero_image'])) {
            $hero_image = Image::find($content['hero_image']['id']);
            $hero_image = $hero_image ? $hero_image->toArray() : [];

            $content['hero_image'] = array_merge($hero_image, $content['hero_image']);
        }

        return $content;
    }
}