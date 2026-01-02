<template>
	<div class="grid grid-cols-3 gap-4">
        <text-input label="Address line one" 
            v-model="form.address_line_one"
            type="text"
            :errors="form.errors.address_line_one"
            required="required"
            placeholder="Please input address line one" 
        />
        <text-input label="Address line two" 
            v-model="form.address_line_two"
            type="text"
            :errors="form.errors.address_line_two"
            placeholder="Please input address line two" 
        />
        <text-input label="Street" 
            v-model="form.street"
            type="text"
            :errors="form.errors.street"
            placeholder="Please input street" 
        />
        <text-input label="City" 
            v-model="form.city"
            type="text"
            :errors="form.errors.city"
            required="required"
            placeholder="Please input city" 
        />
       
        <select-input
            v-model="form.province"
            label="Province"
            placeholder="Select province"
            :options="[]"
            :required="true"
            :errors="form.errors.province"
        />
        <text-input label="Postal code" 
            v-model="form.postal_code"
            type="text"
            :errors="form.errors.postal_code"
            placeholder="Please input postal_code" 
        />
        <select-input
            v-model="form.country"
            label="Country"
            placeholder="Select country"
            :options="[]"
            :required="true"
            :errors="form.errors.country"
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