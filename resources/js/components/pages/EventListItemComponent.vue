<template>
    <div>
        <div class="row">
            <div class="col s12">
                <span class="card-title">{{ event.display_time }}</span>
                <p><b>Event Type: </b>{{ event.type | capitalize }}</p>
                <p><b>Location: </b>{{ event.location }}</p>
                <p v-if="event.type === 'game'"><b>Teams: </b>{{ event.details.away }} at {{ event.details.home }}</p>
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
