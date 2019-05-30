@extends('layouts.admin')

@section('title')
    Admin - Home Edit
@endsection

@section('content')
    <div id="home_edit_app">
        <div class="row">
            <div class="col s12 m5 offset-m1">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Edit Home Page - Revision {{ $current_page->revision }}</span>
                        @if (!$is_current)
                            <p class="red-text">You Are Editing a Previous Version</p>
                        @endif

                        <form action="{{ route('admin_home_edit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $current_page->id }}">

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="title" name="title" type="text" value="{{ old('title', $current_page->title) }}">
                                    <label for="title">Page Title</label>
                                    @if ($errors->has('title'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m4">
                                    <label>
                                        <input name="content[uses_hero_image]" type="checkbox" value="1" {{ old('content.uses_hero_image', !empty($content['uses_hero_image'])) ? 'checked' : '' }}>
                                        <span>Use Hero Image</span>
                                    </label>
                                </div>

                                <div class="col s12 m8">
                                    <img v-if="display_hero_path" :src="display_hero_path" class="responsive-img">
                                    <input
                                        type="hidden"
                                        v-model="hero_image_id"
                                        name="content[hero_image][id]"
                                        id="content_hero_image_id"
                                        value=""
                                        data-initial_value="{{ old('content.hero_image.id', !empty($content['uses_hero_image']) ? $content['hero_image']['id'] : '') }}"
                                    >
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="hero_title" name="content[hero_image][title]" type="text" value="{{ old('content.hero_image.title', !empty($content['uses_hero_image']) ? $content['hero_image']['title'] : '') }}">
                                    <label for="hero_title">Hero Image Title</label>
                                    @if ($errors->has('content.hero_image.title'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('content.hero_image.title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="hero_caption" name="content[hero_image][caption]" type="text" value="{{ old('content.hero_image.caption', !empty($content['uses_hero_image']) ? $content['hero_image']['caption'] : '') }}">
                                    <label for="hero_caption">Hero Image Alt Text</label>
                                    @if ($errors->has('content.hero_image.caption'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('content.hero_image.caption') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="content_title" name="content[title]" type="text" value="{{ old('content.title', $content['title'] ?? '') }}">
                                    <label for="title">Content Title</label>
                                    @if ($errors->has('content.title'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('content.title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="content_content" name="content[content]" id="content_content" class="ck_textarea">
                                        {{ old('content.content', $content['content'] ?? '') }}
                                    </textarea>
                                    <label for="content_content">Main Content</label>
                                    @if ($errors->has('content.content'))
                                        <span class="red-text">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12"><span class="fake_label grey-text">Carousel Images</span></div>
                            </div>
                            <div class="row">
                                <input
                                    id="content_carousel_images"
                                    name="content[carousel_images][ids]"
                                    type="hidden"
                                    value="{{ old('content.carousel_images', $content['carousel_images']['ids'] ?? '') }}"
                                    v-model="carousel_list"
                                >
                                <image-thumbnail
                                    v-for="image in carousel_images.images"
                                    :class="'col s3'"
                                    :image="image"
                                    @image_clicked="carouselClick"
                                ></image-thumbnail>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <select id="content_blog_posts" name="content[blog_posts]" class="material_select">
                                        @for ($i = 0; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ (isset($content['blog_posts']) && $i == $content['blog_posts']) ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <label for="content_blog_posts">Number of Blog Posts</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 m6">
                                    <label>
                                        <input name="save_as_active" type="checkbox" value="1" {{ old('save_as_active', $is_current) ? 'checked' : '' }}>
                                        <span>Save as Active Version</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>{{-- End Form Card --}}
            </div>{{-- End Form Column --}}

            <div class="col s12 m5">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Select Images</span>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">search</i>
                                        <input @keyup="searchImages" v-model="search" placeholder="Search">
                                    </div>

                                    <div class="input-field col s6">
                                        <select @change="getImageList()" v-model="limit" class="material_select">
                                            <option value="20" selected>20</option>
                                            <option value="60">60</option>
                                            <option value="100">100</option>
                                        </select>
                                        <label>Limit</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s6 m3">
                                        <label>
                                            <input
                                                name="image_destination"
                                                type="radio"
                                                value="for_hero"
                                                v-model="image_destination"
                                                @change="getImageList"
                                            >
                                            <span>For Hero</span>
                                        </label>
                                    </div>
                                    <div class="col s6 m3">
                                        <label>
                                            <input
                                                name="image_destination"
                                                type="radio"
                                                value="for_carousel"
                                                v-model="image_destination"
                                                @change="getImageList"
                                            >
                                            <span>For Carousel</span>
                                        </label>
                                    </div>
                                </div>

                                <div v-if="!images_loading && images.length !== 0" class="row">
                                    <image-thumbnail
                                        v-for="image in images"
                                        :class="'col s3'"
                                        :image="image"
                                        @image_clicked="imageThumbClick"
                                    ></image-thumbnail>
                                </div>
                                <div v-else-if="images_loading" class="center-align">
                                    <div class="preloader-wrapper big active">
                                        <div class="spinner-layer spinner-blue-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div><div class="gap-patch">
                                                <div class="circle"></div>
                                            </div><div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <b>There were no images matching your search criteria.</b>
                                </div>
                            </div>

                            <div class="row" v-if="pages && (pages !== 1)">
                                <div class="col s12">
                                    <page-list :page="page" :pages="pages" :links="false" @page_clicked="paginationClick"></page-list>
                                </div>
                            </div>
                        </div>{{-- End Image Picker Card --}}
                    </div>
                </div>

                <div v-if="previous_versions.length > 0" class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="col s12">
                                <div class="card">
                                    <div class="card-content">
                                        <post-versions
                                            :posts="previous_versions"
                                            :edit_url="'/admin/home/'">
                                        </post-versions>

                                        <div class="row" v-if="post_pages && (post_pages !== 1)">
                                            <div class="col s12">
                                                <page-list :page="post_page" :pages="post_pages" :links="false" @page_clicked="postPaginationClick"></page-list>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- End Image Picker Column --}}
        </div>{{-- End Row --}}
    </div> {{-- End Vue App --}}
@endsection

@push('page_scripts')
    <script type="text/javascript">
        HomeEdit = {
            current_page: JSON.parse('{!! json_encode($current_page) !!}'),
            current_content: JSON.parse('{!! json_encode($content) !!}'),
        };
    </script>
    <script type="text/javascript" src="/js/pages/home/edit.js"></script>
@endpush
