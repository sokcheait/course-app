<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { HomeIcon,ChevronRightIcon,PlusCircleIcon,InboxArrowDownIcon } from '@heroicons/vue/24/outline';
import DataTable from '@/Components/DataTable/DataTable.vue';
import StatusBadge from '@/Components/Actions/StatusBadge.vue';
import ImportExcel from '@/Components/Actions/ImportExcel.vue'
import TableActionMenu from '@/Components/DataTable/TableActionMenu.vue'

export default {
    components: {
        AppLayout,
        NavLink,
        Head, Link, 
        router,
        HomeIcon,
        StatusBadge,
        ImportExcel,
        TableActionMenu,
        ChevronRightIcon,
        PlusCircleIcon,
        InboxArrowDownIcon,
        DataTable,
    },
    props: {
        countres: Object,
    },
    setup() {
       
    },
    data() {
        return {
            columns:[
                { label: 'ID', field: 'id' },
                { label: 'Name', field: 'name', render: null  },
                { label: 'Status', slot: 'is_active'},
                { label: 'Action', slot: 'actions', hidden: true },
            ],
            is_import:false
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
                    Countres
                </div>
            </div>
        </template>
        <div>
            <div class="px-4 pt-2 flex flex-col w-full sticky top-0 bg-white z-10">
                <div class="flex w-full items-center p-2">
                    <div class="flex items-center text-sm text-gray-600 dark:text-white">
                        <HomeIcon class="w-4 h-4 mx-1" />
                        <span class="mx-1 mt-[3px]">Home</span>
                        <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                        <span class="mx-1 mt-[3px]">Countres</span>
                    </div>
                </div>
                
            </div>
            <div class="sm:p-7 p-4">
                <DataTable :items="countres" :columns="columns">
                    <template #is_active="{ item }">
                        <StatusBadge :item="item" />
                    </template>
                    <template #actions="{ item }">
                        <TableActionMenu :item="item">
                            <template #default="{ item, close }">
                                <Link
                                    :href="route('#', item.id)"
                                    class="flex w-full px-4 py-2 text-sm hover:bg-gray-100"
                                >
                                    Edit
                                </Link>

                                <button
                                    @click="destroy(item.id, '#')"
                                    class="flex w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50"
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
