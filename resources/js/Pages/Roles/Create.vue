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
        list_permissions: Object,
    },
    setup() {
        
    },
    data() {
        return {
            form:useForm({
                name: '',
                permissions:[]
            }),
            checkedAll:[],
            keyCheckedAll:[],
        }
    },
    created() {
        
    },
    watch:{
        
    },
    methods: {
        onChange(event,permission,key) {
            this.keyCheckedAll = [];
            if(event.target.checked==true) {
                this.checkedAll[key] = event.target.checked;
                Object.keys(permission).forEach((value, index) => {
                    this.form.permissions.push(value);
                });
                this.keyCheckedAll = this.form.permissions;
            }else{
                this.checkedAll[key] = event.target.checked;
                this.form.permissions = this.form.permissions.filter(x => !Object.keys(permission).includes(x));
            }
        },
        updateChildren(event,index) {
            if(event.target.checked==true){
                this.keyCheckedAll.push(event.target.value)
            }else{
                this.keyCheckedAll = this.removeArrValue(this.keyCheckedAll,event.target.value);
            }
            let removeIndex = Object.keys(this.list_permissions[index]).filter(x => !this.keyCheckedAll.includes(x));
            if(removeIndex.length==0){
                this.checkedAll[index] = true;
            }else{
                this.checkedAll[index] = false;
            }
        },
        removeArrValue(arr,value) {
            return  arr.filter(x => !value.includes(x));
        },
        save() {
            this.form.post(this.route('roles.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.toast.success("Create roles successfully");
                },
                onError: () => {
                    this.toast.errors("Create roles Errors");
                },
            });
        }
    },
    mounted(){
       
    }

}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Role Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-2 w-full flex">
                            <label class="px-2 mt-2">Name</label>
                            <input type="text" v-model="form.name" class="w-full px-2 py-2 border-gray-400 rounded-md" placeholder="input name" />
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="">
                            <label class="px-2">Permissions</label>
                        </div>
                        <div class="w-full flex">
                            <ul v-for="(permissions,index) in list_permissions" :key="index" class="ml-4 px-4">
                                <li class="text-base mb-1 px-1 py-1 border-b">
                                    <input type="checkbox" v-model="checkedAll[index]" @change='onChange($event,permissions)' class="" />
                                    <label class="px-2 mt-2 capitalize">{{ index }}</label>
                                </li>
                                <li v-for="(permission,key) in permissions" :key="key" class="text-sm px-2 ml-4 py-1">
                                    <input type="checkbox" v-model="form.permissions" :value="key" @change="updateChildren($event,index)" class=""/>
                                    <label class="px-2 mt-2">{{ permission }}</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex p-2">
                        <div class="px-2 w-full py-1 bg-teal-600 text-white text-center shadow-md rounded-lg cursor-pointer" @click="save">
                            save
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>