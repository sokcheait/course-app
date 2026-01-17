<template>
    <div class="ms-2 relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 focus:outline-none">
                    <Cog8ToothIcon class="w-6 h-6 text-gray-600" />
                </button>
            </template>
            <template #content>
                <div class="block px-2 py-2 text-xs text-gray-400">
                    Manage Settings
                </div>
                <div class="border-t border-gray-200" />
                <div v-for="setting in settings" :key="setting" class="">
                    <Link :href="route(setting.link)" class="px-2 py-2 flex text-center"> 
                        <button class="p-2 flex w-full" :class="{'bg-teal-100 text-teal-500':route().current(setting.link)}">
                            <span><component :is="heroIcons[setting.icon]" class="h-5 w-5" /></span>
                            <span class="text-gray-600 mx-1">{{ setting.lable }}</span>
                        </button>
                    </Link>
                </div>
            </template>
        </Dropdown>
    </div>
</template>
<script>
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import * as heroIcons from '@heroicons/vue/24/solid';
import Settings from '@/Layouts/Settings/index.js';
import { Link } from '@inertiajs/vue3';
import { Cog8ToothIcon } from '@heroicons/vue/24/outline';

export default {
    name: 'SettingDropdown',
    components: {
        Dropdown,
        DropdownLink,
        Link,
        heroIcons,
        Cog8ToothIcon,
    },
    setup() {
        const settings = Settings;
        return { settings }
    },
    data() {
        return {
            heroIcons: heroIcons,
        }
    }
}
</script>