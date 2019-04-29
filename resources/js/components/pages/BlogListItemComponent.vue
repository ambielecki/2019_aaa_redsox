<template>
    <div class="card blog_card col s12">
        <div class="card-content">
            <div class="row">
                <div class="col s12">
                    <span class="card-title"><a :href="'/blog/' + post.slug">{{ post.title }}</a></span>
                    <h6 class="grey-text">Last Updated: {{ post.updated_at | format_date }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <div v-if="!show_post" v-html="post.content.first_paragraph"></div>
                    <div v-else v-html="post.content.content"></div>
                </div>
            </div>

            <div class="row">
                <div class="col sm12">
                    <a class="btn" @click="toggleVisibility">{{ show_post ? 'Hide Post' : 'Show Post' }}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
        data() {
            return {
                show_post: false,
            }
        },
        methods: {
            toggleVisibility() {
                this.show_post = !this.show_post;
            },
        },
        updated() {
            Bielecki.initMaterialBox();
        }
    }
</script>
