<template>
    <div class="flex flex-col shadow-md p-4">
        <div class="flex w-full items-center mb-7 shrink-0">
            <DateFilterButton v-model="dateRange" @update:modelValue="filterDate" :options="dateOptions"/>
            <FilterDropdown v-model="status" @update:modelValue="filterStatus" :options="statusOptions"/>
            <SearchInput v-model="searchQuery" @update:modelValue="search"/>
        </div>
        <Table :items="items" :columns="columns">
            <template v-for="(_, name) in $slots" #[name]="slotProps">
                <slot :name="name" v-bind="slotProps" />
            </template>
        </Table>

        <div class="flex w-full mt-5 items-center pb-0 shrink-0">
            <div class="w-1/2">
                <div class="ml-auto text-gray-500 text-xs sm:inline-flex hidden items-center">
                    <span class="mr-3">Page {{ items.current_page }} of {{ items.last_page }}</span>
                    <select
                    v-model="perPage"
                    @change="changePerPage"
                    class="mr-3 items-center w-16 h-8 pl-2.5 pr-2 px-8 rounded-md shadow text-gray-700 dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0"
                    >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="ml-auto text-gray-500 text-xs sm:inline-flex hidden items-center">
                <div class="ml-auto text-gray-500 text-xs" v-for="link in items.links">
                    <button class="inline-flex items-center h-8 px-4 mx-1 justify-center text-gray-400 rounded shadow border border-gray-200 dark:border-gray-800 leading-none"
                    :class="{'bg-teal-600 text-gray-50': link.active }"
                    @click="changePage(link.url)"
                    >
                        <span v-html="link.label"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link, router,usePage } from '@inertiajs/vue3';
import { PlusCircleIcon } from '@heroicons/vue/24/outline';
import Table from '../DataTable/Table.vue'
import FilterDropdown from '../DataTable/FilterDropdown.vue'
import DateFilterButton from '../DataTable/DateFilterButton.vue'
import SearchInput from '../DataTable/SearchInput.vue'
export default {
    name: 'DataTable',
    components: {
        Head,
        Link,
        router,
        PlusCircleIcon,
        Table,
        FilterDropdown,
        DateFilterButton,
        SearchInput
    },
    props: {
        items: Object,
        columns: Array
    },
    setup() {
        const page = usePage()
        return { page }
    },
    data() {
        return {
            statusOptions:[
                { label: 'All', value: null },
                { label: 'Active', value: true },
                { label: 'Inactive', value: false },
            ],
            dateOptions:[
                { label: 'Last 7 days', value: '7' },
                { label: 'Last 30 days', value: '30' },
                { label: 'Last 90 days', value: '90' },
            ],
            perPage: 10,
            status: null,
            dateRange: 30,
            searchQuery:''
        }
    },
    computed: {
        
    },
    methods: {
        changePage(url){
            if (!url) return;

            router.get(url, {
                status: this.status,
                dateRange: this.dateRange,
                searchQuery: this.searchQuery,
            }, {
                preserveScroll: true,
                preserveState: true,
            })
        },
        changePerPage() {
            router.get(this.page.url, {
                per_page: this.perPage,
                status: this.status,
                dateRange: this.dateRange,
                searchQuery: this.searchQuery
            }, {
                preserveScroll: true,
                preserveState: true
            })
        },
        updateTable() {
            router.get(this.page.url, {
                per_page: this.perPage,
                status: this.status,
                dateRange: this.dateRange,
                searchQuery: this.searchQuery,
            }, {
                preserveScroll: true,
                preserveState: true
            })
        },
        filterStatus(value) {
            this.status = value
            this.updateTable()
        },
        filterDate(value) {
            this.dateRange = value
            this.updateTable()
        },
        search(value) {
            this.searchQuery = value
            this.updateTable()
        }
    },
}
</script>