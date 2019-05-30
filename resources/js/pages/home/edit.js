let app = new Vue({
    el: '#home_edit_app',
    data: {
        carousel_images: {
            images: [],
        },
        count: null,
        current_content: {},
        current_page: {},
        display_hero_path: '',
        hero_image_id: '',
        images: [],
        image_destination: 'for_carousel',
        images_loading: false,
        limit: 20,
        page: 1,
        pages: null,
        post_page: 1,
        post_pages: null,
        previous_versions: [],
        search: null,
        selected_image: {},
    },
    computed: {
        carousel_list: function () {
            let ids = [];

            if (this.carousel_images.hasOwnProperty('images')) {
                this.carousel_images.images.forEach(function (image) {
                    ids.push(image.id);
                });
            }

            return ids.join();
        }
    },
    mounted: function () {
        this.current_page = HomeEdit.current_page;
        this.current_content = HomeEdit.current_content;
        if (HomeEdit.current_content.hasOwnProperty('hero_image')) {
            this.display_hero_path = '/' + HomeEdit.current_content.hero_image.folder + HomeEdit.current_content.hero_image.file_name;
        }

        if (HomeEdit.current_content.hasOwnProperty('carousel_images')) {
            this.carousel_images = HomeEdit.current_content.carousel_images;
            if (!HomeEdit.current_content.carousel_images.hasOwnProperty('images')) {
                this.$set(this.carousel_images, 'images', []);
            }

            this.carousel_images = HomeEdit.current_content.carousel_images;
        }

        this.hero_image_id = document
            .querySelector('#content_hero_image_id')
            .dataset
            .initial_value;

        this.getImageList();
        this.getPreviousVersions();
    },
    methods: {
        imageThumbClick(clicked_image) {
            this.selected_image = clicked_image;

            if (this.image_destination === 'for_hero') {
                this.hero_image_id = clicked_image.id;
                this.display_hero_path = '/' + clicked_image.folder + clicked_image.file_name;
            } else {
                let add = true;

                this.carousel_images.images.forEach(function (image) {
                    if (image.id === clicked_image.id) {
                        add = false;
                    }
                });

                if (add) {
                    this.carousel_images.images.push(clicked_image);
                }
            }
        },

        carouselClick(clicked_image) {
            let index_to_remove = null;

            console.log(this.carousel_images);

            this.carousel_images.images.forEach(function (image, index) {
                if (image.id === clicked_image.id) {
                    index_to_remove = index;
                }
            });

            this.carousel_images.images.splice(index_to_remove, 1);
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

        getPreviousVersions() {
            Axios.get('/api/admin/home/list', {
                params: {
                    page: this.post_page,
                }
            }).then(function (response) {
                app.previous_versions = response.data.posts;
                app.post_page = response.data.page;
                app.post_pages = response.data.pages;
            }).catch(function (error) {
                console.log(error);
            });
        },

        postPaginationClick(page) {
            this.post_page = page;
            this.getPreviousVersions();
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
