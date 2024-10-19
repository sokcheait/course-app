<template>
    <div class="">
        <FullCalendar class="calendar" :options="calendarOptions" />
    </div>
</template>
<script>
import FullCalendar from '@fullcalendar/vue3'; // Import FullCalendar component
import dayGridPlugin from '@fullcalendar/daygrid'; // Day grid plugin (for monthly/weekly views)
import timeGridPlugin from '@fullcalendar/timegrid'; // Time grid plugin (for time-based views)
import interactionPlugin from '@fullcalendar/interaction'; // For interactivity like dragging and clicking

export default {
    components: {
        FullCalendar
    },
    props: {
        plugins: {
            type: Array,
            default: () => [
                dayGridPlugin,
                timeGridPlugin,
                interactionPlugin
            ]
        },
        events: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            calendarOptions: {
                plugins: this.plugins,
                initialView: 'dayGridMonth',
                events: this.events,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                }, 
                editable: true,
                eventClick: this.handleEventClick,
            },
        }
    }
}
</script>