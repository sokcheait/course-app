<template>
    <AppLayout title="System">
        <template #header>
            <div class="ml-auto flex items-center space-x-7">
                <div class="ms-3 relative ">
                    System
                </div>
            </div>
        </template>
        <div class="px-4 pt-4 flex flex-col w-full sticky top-0">
            <div class="flex items-center text-sm text-gray-600 dark:text-white">
                <HomeIcon class="w-4 h-4 mx-1" />
                <span class="mx-1 mt-[3px]">Home</span>
                <ChevronRightIcon class="w-4 h-4 mx-1 mt-[1px]" />
                <span class="mx-1 mt-[3px]">System</span>
            </div>
            <div class="flex items-center space-x-3 sm:mt-7 mt-6 z-50">
                <button
                    v-for="(tab, index) in tabs"
                    :key="index"
                    @click="updateTab(tab)"
                    class="px-3 border-b-2 border-transparent dark:text-gray-400 pb-1.5 flex"
                    :class="{'border-b-teal-500 text-teal-500': selectedTab === tab.componentName }"
                >
                    <component :is="heroIcons[tab.icon]" class="h-5 w-5" />
                    <span class="mx-2 text-sm">{{ tab.label }}</span>
                </button>
            </div>     
        </div>
        <div class="sm:p-7 p-4">
            <div class="overflow-hidden shadow-md sm:rounded-lg">
                <component :is="selectedTab"></component>
            </div>
        </div>      
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { HomeIcon,ChevronRightIcon } from '@heroicons/vue/24/solid';
import Nationality from './Tab/Nationality.vue';
import MaritalStatus from './Tab/MaritalStatus.vue';
import Gender from './Tab/Gender.vue';
import * as heroIcons from '@heroicons/vue/24/outline';

export default {
    components: {
        AppLayout,
        Head, 
        Link, 
        useForm,
        Nationality,
        MaritalStatus,
        Gender,
        heroIcons,
        HomeIcon,ChevronRightIcon
    },
    setup() {
        
    },
    data() {
        return {
            heroIcons: heroIcons,
            selectedTab: 'Nationality',
            tabs: [
                { label: 'Nationality', componentName: 'Nationality',hash: '#nationality',icon:"FlagIcon"},
                { label: 'Marital Status', componentName: 'MaritalStatus',hash: '#marital-status',icon:"UsersIcon"},
                { label: 'Gender', componentName: 'Gender',hash: '#gender',icon:"FaceSmileIcon"},
            ],
        }
    },
    methods: {
        updateTab(tab) {
            this.selectedTab = tab.componentName;
            window.location.hash = tab.hash;
        },
        setTabFromHash() {
            const hash = window.location.hash;
            const matchingTab = this.tabs.find(tab => tab.hash === hash);
            if (matchingTab) {
                this.selectedTab = matchingTab.componentName;
            } else {
                this.selectedTab = this.tabs[0].componentName;
            }
        }
    },
    mounted(){
        this.setTabFromHash();
        window.addEventListener("hashchange", this.setTabFromHash);
    }
}
</script>