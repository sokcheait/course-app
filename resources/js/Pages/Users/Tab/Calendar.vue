<template>
    <div>
        <Qalendar 
            :events="events"
            :config="config"
        /> 
    </div>
</template>

<script>
import Qalendar from '@/Pages/Components/Calendars/Qalendar.vue';
export default {
    name: 'Calendar',
    components: {
        Qalendar
    },
    data() {
        return {
            events: [
                {
                    title: "សេន ដារ៉ា",
                    topic: "Rejected",
                    with: "Albert Einstein",
                    time: { start: this.convertDateFormat("13/10/2024 20:05"), end: this.convertDateFormat("13/10/2024 20:35") },
                    color: "green",
                    isEditable: false,
                    id: "de471c78cb5c",
                },
                {
                    title: "Advanced algebra",
                    with: "Pheobe Buffay",
                    time: { start: this.convertDateFormat("13/10/2024 20:05"), end: this.convertDateFormat("13/10/2024 20:35") },
                    colorScheme: "sports",
                    isEditable: false,
                    id: "6d3c0980a5cf",
                    location: "Zoom",
                },
                {
                    title: "សេន ដារ៉ា",
                    topic: "Rejected",
                    with: "Albert Einstein",
                    time: { start: this.convertDateFormat("07/10/2024 20:05"), end: this.convertDateFormat("07/10/2024 20:35") },
                    color: "green",
                    isEditable: false,
                    id: "de4718cb5c",
                },
                {
                    title: "សេន ដារ៉ា",
                    topic: "Rejected",
                    with: "Albert Einstein",
                    time: { start: this.convertDateFormat("07/10/2024 20:05"), end: this.convertDateFormat("07/10/2024 20:35") },
                    color: "green",
                    isEditable: false,
                    id: "de478cb5c",
                },
                {
                    title: "សេន ដារ៉ា",
                    topic: "Rejected",
                    with: "Albert Einstein",
                    time: { start: this.convertDateFormat("07/10/2024 20:05"), end: this.convertDateFormat("07/10/2024 20:35") },
                    color: "green",
                    isEditable: false,
                    id: "c78cb5c",
                },
                {
                    title: "Advanced algebra",
                    with: "Pheobe Buffay",
                    time: { start: this.convertDateFormat("02/10/2024 20:05"), end: this.convertDateFormat("03/10/2024 20:35") },
                    colorScheme: "sports",
                    isEditable: false,
                    id: "6d3c0980a5cf",
                    location: "Zoom",
                },
            ],

            config: {
                locale: "en-US",
                defaultMode: "month",
                style: {
                colorSchemes: {
                    meetings: {
                    color: "#fff",
                    backgroundColor: "#131313",
                    },
                    sports: {
                    color: "#fff",
                    backgroundColor: "#ff4081",
                    },
                },
                },
            },
        }
    },
    methods: {
        convertDateFormat(dateStr) {
            // Split the date part and the time part
            let [datePart, timePart] = dateStr.split(' ');

            // Split the date by slashes to get day, month, and year
            let [day, month, year] = datePart.split('/');

            // Reformat the date to yyyy-mm-dd
            let newDatePart = `${year}-${month}-${day}`;

            // Combine the new date format with the original time part
            return `${newDatePart} ${timePart}`;
        },
    }
}
</script>