<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import SaveButton from '@/Components/Actions/SaveButton.vue';
import BackButton from '@/Components/Actions/BackButton.vue';
import TextInput from '@/Pages/Components/Forms/TextInput.vue';

export default {
    components: {
        AppLayout,
        Head, 
        Link, 
        useForm,
        SaveButton,
        BackButton,
        TextInput,
        HomeIcon,ChevronRightIcon
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
    <AppLayout title="Create Role">
        <template #header>
            <div class="ml-auto flex items-center space-x-7">
                <div class="ms-3 relative ">
                    Role
                </div>
            </div>
        </template>
        <div class="px-4 pt-4 flex flex-col w-full sticky top-0">
            <div class="flex items-center text-sm text-gray-600 dark:text-white">
                <HomeIcon class="w-4 h-4 mx-1" />
                <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                <Link :href="route('roles.index')" class="mt-[3px]">
                    <span class="mx-1">Roles</span>
                </Link>
                <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                <span class="mx-1 mt-[3px]">Create</span>
            </div>
        </div>
        <div class="sm:p-7 p-4">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-2 gap-4">
                    <text-input label="Name" 
                        v-model="form.name"
                        type="text"
                        :errors="form.errors.name"
                        required="required"
                        placeholder="Please input name" 
                    />
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
                <div class="flex py-4 justify-end text-center">
                    <save-button @click="save" class="" />
                    <back-button label="Back" />
                </div>
            </div>
        </div>      
    </AppLayout>
</template>