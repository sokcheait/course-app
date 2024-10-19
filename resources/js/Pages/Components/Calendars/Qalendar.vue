<template>
    <div class="">
        <Qalendar 
            :events="events"
            :config="config"
        />
    </div>
</template>
<script>
import { Qalendar } from "qalendar";
export default {
    components: {
        Qalendar
    },
    props: {
        events: {
            type: Array,
            default: [],
        },
        config: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            
        }
    }
}
</script>
<style>
    @import "qalendar/dist/style.css";
</style>