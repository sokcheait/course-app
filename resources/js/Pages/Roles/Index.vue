<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { markRaw,shallowRef } from 'vue'
import DestroyMixin from '@/Actions/DestroyMixin.js'
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/outline';
import { PlusCircleIcon } from '@heroicons/vue/24/outline';
import DataTable from '@/Components/DataTable/DataTable.vue';
import StatusBadge from '@/Components/Actions/StatusBadge.vue';
import TableActionMenu from '@/Components/DataTable/TableActionMenu.vue'
export default {
    mixins: [DestroyMixin],
    components: {
        AppLayout,
        StatusBadge,
        TableActionMenu,
        NavLink,
        DataTable,
        Head, Link, router,
        HomeIcon,ChevronRightIcon,PlusCircleIcon
    },
    props:{
        roles:Object
    },
    setup() {
      
    },
    data() {
        return {
           columns:[
                { label: 'ID', field: 'id' },
                { label: 'Name', field: 'name' },
                { label: 'Status', slot: 'is_active'},
                { label: 'Created At', field: 'created_at_formatted' },
                { label: 'Updated At', field: 'updated_at_formatted' },
                { label: 'Action', slot: 'actions', hidden: true },
            ]
        }
    },
    methods: {
        // destroy(item){
        //     console.log(item)
        // }
    }
}    
</script>

<template>
    <AppLayout title="Role">
        <template #header>
            <div class="ml-auto flex items-center space-x-7">
                <div class="ms-3 relative ">
                    Roles
                </div>
            </div>
        </template>
        <div class="px-4 pt-2 flex flex-col w-full sticky top-0">
            <div class="flex w-full items-center p-2">
                <div class="flex items-center text-sm text-gray-600 dark:text-white">
                    <HomeIcon class="w-4 h-4 mx-1" />
                    <span class="mx-1 mt-[3px]">Home</span>
                    <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                    <span class="mx-1 mt-[3px]">Roles</span>
                </div>
            </div>
        </div>
        <div class="sm:p-7 p-4">
            <div class="flex w-full items-center mb-7">
                <Link v-if="can('roles.create') || is_superAdmin('super-admin')" :href="route('roles.create')" class="inline-flex bg-teal-500 mr-3 items-center h-8 pl-2.5 pr-2 rounded-md shadow text-white dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0 hover:opacity-75">
                    <PlusCircleIcon class="w-5 h-5 mr-1" />
                    <span class="text-center">Create role</span>
                </Link>
            </div>
            <DataTable :items="roles" :columns="columns">
                <template #is_active="{ item }">
                    <StatusBadge :item="item" />
                </template>
                <template #actions="{ item }">
                    <TableActionMenu :item="item">
                        <template #default="{ item, close }">
                            <Link
                                :href="route('roles.edit', item.id)"
                                class="flex w-full px-4 py-2 text-sm hover:bg-gray-100"
                            >
                                Edit
                            </Link>

                            <button
                                @click="destroy(item.id, 'roles.destroy')"
                                class="flex w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                            >
                                Delete
                            </button>
                        </template>
                    </TableActionMenu>
                </template>
            </DataTable>
        </div>    
    </AppLayout>
</template>