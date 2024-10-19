<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import DataTable from '../Users/Tab/DataTable.vue';
import Calendar from '../Users/Tab/Calendar.vue';
import Transfer from '../Users/Tab/Transfer.vue';

export default {
    components: {
        AppLayout,
        NavLink,
        Head, Link, router,
        HomeIcon,ChevronRightIcon,
        DataTable,
        Transfer,
        Calendar,
    },
    props: {
        users: Object,
    },
    setup() {
       
    },
    data() {
        return {
            selectedTab: 'DataTable',
            tabs: [
                { label: 'Data Table', componentName: 'DataTable',hash: '#user-tab-datatable'},
                { label: 'Calendar', componentName: 'Calendar',hash: '#user-tab-calendar' },
                { label: 'Transfer', componentName: 'Transfer',hash: '#user-tab-transfer'},
            ],
            tabDataTable:null,
        }
    },
    mounted() {
        // When the component mounts, check the hash in the URL
        this.setTabFromHash();
        // Add a listener for hash changes
        window.addEventListener("hashchange", this.setTabFromHash);
    },
    methods: {
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
            <div class="sm:px-7 sm:pt-7 px-4 pt-4 flex flex-col w-full border-b border-gray-200 bg-white dark:bg-gray-900 dark:text-white dark:border-gray-800 sticky top-0">
                <div class="flex w-full items-center border rounded-lg p-2">
                    <div class="flex items-center text-sm text-gray-600 dark:text-white">
                        <HomeIcon class="w-4 h-4 mx-1" />
                        <span class="mx-1 mt-[3px]">Home</span>
                        <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                        <span class="mx-1 mt-[3px]">Users</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3 sm:mt-7 mt-4">
                    <button
                        v-for="(tab, index) in tabs"
                        :key="index"
                        @click="updateTab(tab)"
                        class="px-3 border-b-2 border-transparent dark:text-gray-400 pb-1.5"
                        :class="{'border-b-blue-500 text-blue-500': selectedTab === tab.componentName }"
                    >
                        {{ tab.label }}
                    </button>
                </div>
            </div>
            {{ tabDataTable }}
            <div class="sm:p-7 p-4">
                <component :is="selectedTab" :users="users"></component>
            </div>   
        </div>
    </AppLayout>
</template>
