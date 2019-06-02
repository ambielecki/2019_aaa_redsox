<template>
    <div>
        <div class="row">
            <div class="col s12">
                <span class="card-title">{{ event.start_time }}</span>
<!--                <h6 class="grey-text">Last Updated: {{ post.updated_at | format_date }}</h6>-->
            </div>
        </div>
        <hr v-if="hr && index < length - 1">
    </div>
</template>

<script>
    export default {
        props: ['event', 'hr', 'length', 'index'],
    }
</script>
