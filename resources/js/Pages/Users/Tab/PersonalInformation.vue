<template>
	<div class="grid grid-cols-3 gap-4">
        <text-input label="First Name" 
            v-model="form.first_name"
            type="text"
            :errors="form.errors.first_name"
            required="required"
            placeholder="Please input first name" 
        />
        <text-input label="Last Name" 
            v-model="form.last_name"
            type="text"
            :errors="form.errors.last_name"
            required="required"
            placeholder="Please input last name" 
        />
        <text-input label="Full Name" 
            v-model="form.name"
            type="text"
            :errors="form.errors.name"
            placeholder="Please input full name" 
        />
        <text-input label="Email" 
            v-model="form.email"
            type="text"
            :errors="form.errors.email"
            required="required"
            placeholder="Please input email" 
        />
        <text-input label="Phone Number" 
            v-model="form.phone_number"
            type="text"
            :errors="form.errors.phone_number"
            required="required"
            placeholder="Please input phone number" 
        />
        <select-input
            v-model="form.gender"
            label="Gender"
            placeholder="Select gender"
            :options="[
                { label: 'Male', value: 'male' },
                { label: 'Female', value: 'female' },
                { label: 'Other', value: 'other' }
            ]"
            :required="true"
            :errors="form.errors.gender"
        />
        <DateTimeInput
            v-model="form.date_of_birth"
            label="Date of Birth"
            mode="date"
            :required="true"
            :errors="form.errors.date_of_birth"
        />
        <select-input
            v-model="form.nationality"
            label="Nationality"
            placeholder="Select nationality"
            :options="[]"
            :required="true"
            :errors="form.errors.nationality"
        />
        <select-input
            v-model="form.marital_status"
            label="Marital Status"
            placeholder="Select marital status"
            :options="[]"
            :required="true"
            :errors="form.errors.marital_status"
        />
    </div>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import TextInput from '@/Components/Forms/TextInput.vue';
import SelectInput from "@/Components/Forms/SelectInput.vue";
import DateTimeInput from '@/Components/Forms/DateTimeInput.vue'

export default {
    components: {
        Head, 
        Link, 
        useForm,
        HomeIcon,ChevronRightIcon,
        TextInput,
        SelectInput,
        DateTimeInput
    },
    props: {
        form:Object
    },
    setup() {
        
    },
    data() {
        return {
            // form:useForm({
            //     name: '',
            //     email:'',
            //     gender:''
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