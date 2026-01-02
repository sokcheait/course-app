<template>
    <div class="shadow-md p-4">
        <div class="flex w-full items-center mb-7">
            <button class="inline-flex mr-3 items-center h-8 pl-2.5 pr-2 rounded-md shadow text-gray-700 dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0">
                <svg viewBox="0 0 24 24" class="w-4 mr-2 text-gray-400 dark:text-gray-600" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Last 30 days
                <svg viewBox="0 0 24 24" class="w-4 ml-1.5 text-gray-400 dark:text-gray-600" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <button class="inline-flex items-center h-8 pl-2.5 pr-2 rounded-md shadow text-gray-700 dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0">
                Filter by
                <svg viewBox="0 0 24 24" class="w-4 ml-1.5 text-gray-400 dark:text-gray-600" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
        </div>
        
        <!-- <Table :items="items" :columns="columns" /> -->

        <Table :items="items" :columns="columns">
            <template v-for="(_, name) in $slots" #[name]="slotProps">
                <slot :name="name" v-bind="slotProps" />
            </template>
        </Table>

        <div class="flex w-full mt-5 items-center pb-0">
            <div class="w-1/2">
                <div class="ml-auto text-gray-500 text-xs sm:inline-flex hidden items-center">
                    <span class="mr-3">Page {{ items.current_page }} of 4</span>
                    <select name="per_page" onchange="this.form.submit()" class="mr-3 items-center w-12 h-8 pl-2.5 pr-2 px-8 rounded-md shadow text-gray-700 dark:text-gray-400 dark:border-gray-800 border border-gray-200 leading-none py-0">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
            </div>
            <div class="ml-auto text-gray-500 text-xs sm:inline-flex hidden items-center">
                <div class="ml-auto text-gray-500 text-xs" v-for="link in items.links">
                    <button class="inline-flex items-center h-8 px-4 mx-1 justify-center text-gray-400 rounded shadow border border-gray-200 dark:border-gray-800 leading-none"
                    :class="{'bg-slate-200': link.active }"
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
import { Head, Link, router } from '@inertiajs/vue3';
import { PlusCircleIcon } from '@heroicons/vue/24/outline';
import Table from '../DataTable/Table.vue'
export default {
    name: 'DataTable',
    components: {
        Head,
        Link,
        router,
        PlusCircleIcon,
        Table
    },
    props: {
        items: Object,
        columns: Array
    },
    data() {
        return {
            posts:null
        }
    },
    methods: {
        changePage(url){

            this.$inertia.get(url,{
                preserveScrollPosition: true,
                replace: false,
                only: ['users.*'],
                // meta: {
                //     title: 'DataTable'
                // },
                onBeforeLeave(to, from, next) {
                    console.log('Leaving from:', from.name);
                    // console.log('Transitioning to:', to.name);
                    // next();
                },
                onUpdated(to, from, isInitial, prevData, newData) {

                },
                onError(error, from, to, status, request, response) {
                    // console.error('Error:', error);
                },
                onCompleted(response, from, to) {
                    // console.log('Completed:', response);
                },
                onLoading(name, message, percentage) {

                }
            })
        }
    },
}
</script>