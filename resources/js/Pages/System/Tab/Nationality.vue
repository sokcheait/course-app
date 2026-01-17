<template>
    <div class="block w-full">
        <section class="border-b border-b-gray-300">
            <form @submit.prevent="save">
                <div class="grid grid-cols-3 gap-4">
                    <text-input label="Name" 
                        v-model="form.name"
                        type="text"
                        :errors="form.errors.name"
                        required="required"
                        placeholder="Please input name" 
                    />
                    <text-input label="Order" 
                        v-model="form.sort_order"
                        type="number"
                        :errors="form.errors.sort_order"
                        placeholder="Please input order" 
                    />
                    <ToggleSwitch v-model="form.is_active" label="Active" />
                </div>
                <div class="flex py-4 justify-end text-center">
                    <save-button @click="save" class="" />
                    <back-button label="Back" />
                </div>
            </form>
        </section>
        <section class="p-4">
            DataTable
        </section>
    </div>
</template>
<script>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import TextInput from '@/Components/Forms/TextInput.vue';
import { useToast } from "vue-toastification";
import SaveButton from '@/Components/Actions/SaveButton.vue';
import BackButton from '@/Components/Actions/BackButton.vue';
import ToggleSwitch from '@/Components/Forms/ToggleSwitch.vue'

export default {
    components: {
        Head, 
        Link, 
        useForm,
        HomeIcon,ChevronRightIcon,
        TextInput,
        SaveButton,
        BackButton,
        ToggleSwitch
    },
    props: {
        form:Object
    },
    setup() {
        const toast = useToast();

        return { toast }
    },
    data() {
        return {
            form:useForm({
                type:'nationality',
                name:'',
                sort_order:null,
                is_active: false,
            }),
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
        save() {
            this.form.post(this.route('system.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.toast.success("Create user successfully");
                },
                onError: () => {
                    // this.toast.error("Create user Errors");
                },
            });
        },
    },
}
</script>