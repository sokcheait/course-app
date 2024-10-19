<template>
    <div class="">
        <ProCalendar :events="events" :view=view :loading="false" date="'isoStringDate'" @calendarClosed="false" />
    </div>
</template>
<script>
// import { ProCalendar } from "@lbgm/pro-calendar-vue";
// import "@lbgm/pro-calendar-vue/style";

export default {
    components: {
        // ProCalendar
    },
    props: {
        events: {
            type: Array,
            default: [],
        },
        view: {
            type: String,
            default: 'month',
        },
    },
    data() {
        return {
            
        }
    }
}
</script>