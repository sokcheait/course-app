<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import TextInput from '@/Pages/Components/Forms/TextInput.vue';

import PersonalInformation from '../Users/Tab/PersonalInformation.vue';
import ContactInformation from '../Users/Tab/ContactInformation.vue';
import AccountAuthentication from '../Users/Tab/AccountAuthentication.vue';
import SaveButton from '@/Components/Actions/SaveButton.vue';
import BackButton from '@/Components/Actions/BackButton.vue';


export default {
    components: {
        AppLayout,
        Head, 
        Link, 
        useForm,
        NavLink,
        HomeIcon,ChevronRightIcon,
        TextInput,
        ContactInformation,
        PersonalInformation,
        AccountAuthentication,
        SaveButton,
        BackButton
    },
    props: {
        roles: Object,
    },
    setup() {
        
    },
    data() {
        return {
            form:useForm({
                first_name: '',
                last_name:'',
                name:'',
                phone_number:'',
                email:null,
                gender:'',
                date_of_birth:'',
                nationality:'',
                marital_status:'',

                address_line_one:'',
                address_line_two:'',
                street:'',
                city:'',
                province:'',
                postal_code:'',
                country:'',

                password:null,
                role_id:[]
            }),

            selectedTab: 'PersonalInformation',
            tabs: [
                { label: 'Personal Information', componentName: 'PersonalInformation',hash: '#user-tab-personal-information'},
                { label: 'Contact Information', componentName: 'ContactInformation',hash: '#user-tab-contact-information'},
                { label: 'Account Authentication', componentName: 'AccountAuthentication',hash: '#user-tab-account-authentication'},
            ],
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
            this.form.post(this.route('users.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.toast.success("Create user successfully");
                },
                onError: () => {
                    // this.toast.error("Create user Errors");
                },
            });
        },
        updateTab(tab) {
            // Change the selected tab and update the URL hash
            this.selectedTab = tab.componentName;
            window.location.hash = tab.hash;
        },
        setTabFromHash() {
            // Get the current hash from the URL
            const hash = window.location.hash;

            // Find the corresponding tab for the current hash
            const matchingTab = this.tabs.find(tab => tab.hash === hash);

            // If a matching tab exists, set it as the active tab
            if (matchingTab) {
                this.selectedTab = matchingTab.componentName;
            } else {
                // If no hash or invalid hash, fall back to default
                this.selectedTab = this.tabs[0].componentName;
            }
        }
    },
    mounted(){
        this.setTabFromHash();
        // Add a listener for hash changes
        window.addEventListener("hashchange", this.setTabFromHash);
    }

}
</script>

<template>
    <AppLayout title="Create User">
        <template #header>
            <div class="ml-auto flex items-center space-x-7">
                <div class="ms-3 relative ">
                    Users
                </div>
            </div>
        </template>
        <div class="px-4 pt-4 flex flex-col w-full sticky top-0">
            <div class="flex items-center text-sm text-gray-600 dark:text-white">
                <HomeIcon class="w-4 h-4 mx-1" />
                <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                <Link :href="route('users.index')" class="mt-[3px]">
                    <span class="mx-1">Users</span>
                </Link>
                <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                <span class="mx-1 mt-[3px]">Create</span>
            </div>
            <div class="flex items-center space-x-3 sm:mt-7 mt-6 z-50">
                <button
                    v-for="(tab, index) in tabs"
                    :key="index"
                    @click="updateTab(tab)"
                    class="px-3 border-b-2 border-transparent dark:text-gray-400 pb-1.5"
                    :class="{'border-b-teal-500 text-teal-500': selectedTab === tab.componentName }"
                >
                    {{ tab.label }}
                </button>
            </div>     
        </div>
        <div class="sm:p-7 p-4">
            <div class="overflow-hidden shadow-md sm:rounded-lg">
                <form @submit.prevent="save">
                    <component :is="selectedTab" v-model:form="form"></component>
                    <div class="flex py-4 justify-end text-center">
                        <save-button @click="save" class="" />
                        <back-button label="Back" />
                    </div>
                </form>
            </div>
        </div>      
    </AppLayout>
</template>