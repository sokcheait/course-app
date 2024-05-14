<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';

export default {
    components: {
        AppLayout,
        Head, 
        Link, 
        useForm,
        NavLink,
        HomeIcon,ChevronRightIcon
    },
    props: {
        roles: Object,
    },
    setup() {
        
    },
    data() {
        return {
            form:useForm({
                name: '',
                email:null,
                password:null,
                password_confirmation:null,
                roles:[]
            }),
        }
    },
    created() {
        
    },
    watch:{
        
    },
    methods: {
        save() {
            this.form.post(this.route('users.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.toast.success("Create user successfully");
                },
                onError: () => {
                    this.toast.errors("Create user Errors");
                },
            });
        }
    },
    mounted(){
       
    }

}
</script>

<template>
    <AppLayout title="Create User">
        <template #header>
            <NavLink :href="route('users.index')" :active="route().current('users.index')" class="px-4">
                Users
            </NavLink>
            <NavLink v-if="can('users.create') || is_superAdmin('super-admin')" :href="route('users.create')" :active="route().current('users.create')" class="px-4">
                Create User
            </NavLink>
        </template>
        <div class="sm:px-7 sm:pt-7 px-4 pt-4 flex flex-col w-full border-b border-gray-200 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-800 sticky top-0">
            <div class="flex w-full items-center border rounded-lg p-2">
                <div class="flex items-center text-sm text-gray-600 dark:text-white">
                    <HomeIcon class="w-4 h-4 mx-1" />
                    <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                    <span class="mx-1 mt-[3px]">Users</span>
                    <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                    <span class="mx-1 mt-[3px]">Create</span>
                </div>
            </div>
            <div class="flex items-center space-x-3 sm:mt-7 mt-4">
                <Link :href="route('users.create')" class="px-3 border-b-2 text-gray-500 dark:text-white dark:border-white pb-1.5" :class="{'border-blue-500 text-blue-600 ':route().current('users.create')}">Information</Link>
                <a href="#" class="px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5">Transfer</a>
                <a href="#" class="px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5 sm:block hidden">Notifications</a>
                <a href="#" class="px-3 border-b-2 border-transparent text-gray-600 dark:text-gray-400 pb-1.5 sm:block hidden">Cards</a>
            </div>
        </div>
        <div class="sm:p-7 p-4">
            <div class="overflow-hidden shadow-md sm:rounded-lg">
                <form action="">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-2 w-full">
                            <label class="mt-2 pb-2">Name</label>
                            <input type="text" v-model="form.name" class="w-full px-2 py-2 border-gray-400 rounded-md" placeholder="Please input name" />
                        </div>
                        <div class="p-2 w-full">
                            <label class="mt-2 pb-2">Email</label>
                            <input type="text" v-model="form.email" class="w-full px-2 py-2 border-gray-400 rounded-md" placeholder="Please input email" />
                        </div>
                        <div class="p-2 w-full">
                            <label class="mt-2 pb-2">Password</label>
                            <input type="password" v-model="form.password" class="w-full px-2 py-2 border-gray-400 rounded-md" placeholder="Please input password" />
                        </div>
                        <div class="p-2 w-full">
                            <label class="mt-2 pb-2">Confirm Password</label>
                            <input type="password" v-model="form.password_confirmation" class="w-full px-2 py-2 border-gray-400 rounded-md" placeholder="Please input confirm password" />
                        </div>
                        <!-- <div class="p-2 w-full">
                            <label class="mt-2 pb-2">Roles</label>
                            <select v-model="form.roles" class="w-full px-2 py-2 border-gray-400 rounded-md">
                                <option v-for="role in roles" :key="role" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div> -->
                    </div>
                    
                    <div class="flex p-2">
                        <div class="mr-4 px-2 w-16 py-2 bg-teal-600 text-white text-center shadow-md rounded-lg cursor-pointer" @click="save">
                            Save
                        </div>
                        <div class="mr-4 px-2 w-16 py-2 bg-rose-500 text-white text-center shadow-md rounded-lg cursor-pointer">
                            Back
                        </div>
                    </div>
                </form>
            </div>
        </div>
                
    </AppLayout>
</template>