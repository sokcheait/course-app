<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Head, 
        Link, 
        useForm,
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1 class="p-3">Create User</h1>
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
                            <div class="p-2 w-full">
                                <label class="mt-2 pb-2">Roles</label>
                                <select v-model="form.roles" class="w-full px-2 py-2 border-gray-400 rounded-md">
                                    <option v-for="role in roles" :key="role" :value="role.id">{{ role.name }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex p-2">
                            <div class="px-2 w-full py-1 bg-teal-600 text-white text-center shadow-md rounded-lg cursor-pointer" @click="save">
                                save
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </AppLayout>
</template>