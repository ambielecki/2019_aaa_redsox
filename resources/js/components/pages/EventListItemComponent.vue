<template>
    <div>
        <div class="row">
            <div class="col s12">
                <span class="card-title">{{ event.display_time }}</span>
<!--                <h6 class="grey-text">Last Updated: {{ post.updated_at | format_date }}</h6>-->
                <p>{{ event.type }} - {{ event.location }}</p>
                <p v-if="event.type === 'game'">{{ event.details.away }} at {{ event.details.home }}</p>
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
