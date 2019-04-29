let app = new Vue({
    el: '#blog_app',
    data: {
        count: null,
        errors: {},
        images: [],
        images_loading: false,
        limit: 20,
        page: 1,
        pages: null,
        search: null,
        selected_image: {},
        show_selected: false,
        slug: '',
    },
    mounted: function () {
        this.getImageList();

        this.slug = document
            .querySelector('#slug')
            .dataset
            .initial_value;
    },
    methods: {
        imageThumbClick(clicked_image) {
            this.show_selected = true;
            this.selected_image = clicked_image;
        },

        paginationClick(page) {
            this.page = page;
            this.getImageList();
        },

        getImageList() {
            this.images_loading = true;
            Axios.get('/api/admin/images', {
                params: {
                    page: this.page,
                    limit: this.limit,
                    search: this.search,
                    is_hero: this.image_destination === 'for_hero',
                }
            }).then(function (response) {
                app.images_loading = false;
                app.images = response.data.images;
                app.count = response.data.count;
                app.limit = response.data.limit;
                app.page = response.data.page;
                app.pages = response.data.pages;
                app.selected_image = {};

                app.images.forEach(function (image, index) {
                    Vue.set(app.images[index], 'is_active', false);
                });
            }).catch(function (error) {
                this.images_loading = false;
                console.log(error);
            });
        },

        searchImages: Bielecki.debounce(function () {
            this.getImageList();
        }, 500),

        checkSlug: Bielecki.debounce(function () {
            let title = document.querySelector('#title').value;
            Vue.set(app.errors, 'title', '');
            Axios.post('/api/admin/blog/slug-check', {
                title: title,
            }).then(function (response) {
                Vue.set(app.errors, 'title', response.data.error ? 'Slug already in use, please try a different title' : '');
                app.slug = response.data.slug;
                Materialize.updateTextFields();
            }).catch(function (error) {
                console.log(error);
            });
        }, 500),

        imageCopyClick(image_id) {
            console.log(image_id);
        },
    },
});

document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector( '.ck_textarea' ))
        .catch(error => {
            console.error(error);
        });

    new ClipBoard('.copy_btn');
});
