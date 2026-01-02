<template>
	<div class="grid grid-cols-3 gap-4">
        <text-input label="Password" 
            v-model="form.password"
            type="text"
            :errors="form.errors.password"
            required="required"
            placeholder="Please input password" 
        />
        <select-input
            v-model="form.role_id"
            label="Role"
            placeholder="Select Role"
            :options="[]"
            :required="true"
            :errors="form.errors.role_id"
        />
        <ToggleSwitch v-model="form.is_active" label="Active" />
    </div>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import TextInput from '@/Components/Forms/TextInput.vue';
import SelectInput from "@/Components/Forms/SelectInput.vue";
import DateTimeInput from '@/Components/Forms/DateTimeInput.vue'
import ToggleSwitch from '@/Components/Forms/ToggleSwitch.vue'

export default {
    components: {
        Head, 
        Link, 
        useForm,
        HomeIcon,ChevronRightIcon,
        TextInput,
        SelectInput,
        DateTimeInput,
        ToggleSwitch
    },
    props: {
        form:Object
    },
    setup() {
        
    },
    data() {
        return {
            // form:useForm({
            //     is_active: false,
            // }),
        }
    },
    created() {
        
    },
    watch:{
        // 'form.name':function(value) {
        //     if(value){
        //         this.form.errors.name=null;
        //     }
        // }
    },
    methods: {
        
    },
}
</script>