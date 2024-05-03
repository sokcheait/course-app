<template>
    <div class="flex mx-auto flex-grow mt-4 flex-col text-gray-400 space-y-4">
        <div v-for="nav_menus in menu" :key="nav_menus" class="">
            <Link :href="route(nav_menus.link)"> 
                <button class="h-10 w-12 dark:text-gray-500 rounded-md flex items-center justify-center" :class="{'bg-blue-100 text-blue-500':route().current(nav_menus.link)}">
                    <component :is="heroIcons[nav_menus.icon]" class="h-5 w-6" />
                </button>
            </Link>
        </div>
    </div>
</template>
<script>
import Nav from '@/Layouts/Nav/index.js';
import * as heroIcons from '@heroicons/vue/24/solid';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
export default {
    name: "Navigation",
    components: {
        Nav,
        heroIcons,
        Link,
        NavLink
    },
    setup() {
        const menu = Nav;
        return { menu }
    },
    data() {
        return {
            heroIcons: heroIcons,
        }
    }
}
</script>