<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { HomeIcon,ChevronRightIcon,PlusCircleIcon } from '@heroicons/vue/24/outline';
import DataTable from '@/Components/DataTable/DataTable.vue';
import StatusBadge from '@/Components/Actions/StatusBadge.vue';
import TableActionMenu from '@/Components/DataTable/TableActionMenu.vue'

export default {
    components: {
        AppLayout,
        NavLink,
        Head, Link, 
        router,
        HomeIcon,
        StatusBadge,
        TableActionMenu,
        ChevronRightIcon,
        PlusCircleIcon,
        DataTable,
    },
    props: {
        users: Object,
    },
    setup() {
       
    },
    data() {
        return {
            columns:[
                { label: 'ID', field: 'id' },
                { label: 'Name', field: 'name', render: null  },
                { label: 'Email', field: 'email', hidden: false },
                { label: 'Status', field: 'is_active', render: StatusBadge  },
                { label: 'Action', slot: 'actions', hidden: true },
            ]
        }
    },
    mounted() {
       
    },
    methods: {
        
    }
}
</script>

<template>
    <AppLayout title="User">
        <template #header>
            <div class="ml-auto flex items-center space-x-7">
                <div class="ms-3 relative ">
                    Users
                </div>
            </div>
        </template>
        <div>
            <div class="px-4 pt-2 flex flex-col w-full sticky top-0">
                <div class="flex w-full items-center p-2">
                    <div class="flex items-center text-sm text-gray-600 dark:text-white">
                        <HomeIcon class="w-4 h-4 mx-1" />
                        <span class="mx-1 mt-[3px]">Home</span>
                        <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                        <span class="mx-1 mt-[3px]">Users</span>
                    </div>
                </div>
            </div>
            <div class="sm:p-7 p-4">
                <div class="flex w-full items-center mb-7">
                    <Link v-if="can('users.create') || is_superAdmin('super-admin')" :href="route('users.create')" class="inline-flex bg-teal-500 mr-3 items-center h-8 pl-2.5 pr-2 rounded-md shadow text-white dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0 hover:opacity-75">
                        <PlusCircleIcon class="w-5 h-5 mr-1" />
                        <span class="text-center">Create user</span>
                    </Link>
                </div>
                <DataTable :items="users" :columns="columns">
                    <template #actions="{ item }">
                        <TableActionMenu :item="item">
                            <template #default="{ item, close }">
                                <button
                                    @click="edit(item); close()"
                                    class="block w-full px-4 py-2 text-sm hover:bg-gray-100"
                                >
                                    Edit
                                </button>

                                <button
                                    @click="destroy(item); close()"
                                    class="block w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                >
                                    Delete
                                </button>
                            </template>
                        </TableActionMenu>
                    </template>
                </DataTable>
            </div>
        </div>
    </AppLayout>
</template>
