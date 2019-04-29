let app = new Vue({
    el: '#image_list_app',
    data: {
        images: [],
        images_loading: false,
        selected_image: {},
        page: 1,
        pages: null,
        limit: 20,
        count: null,
        search: null,
    },
    mounted: function () {
        this.getImageList();
    },
    methods: {
        imageThumbClick(clicked_image) {
            this.selected_image = clicked_image;

            this.images.forEach(function (image) {
                if (image.id === clicked_image.id) {
                    image.is_active = true;
                } else {
                    image.is_active = false;
                }
            })
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
    },
});
