<template>
    <div class="ms-2 relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <button class="relative p-2 rounded-full" :class="bgClass">
                    <svg
                        class="w-5 h-5"
                        :class="[iconClass, wiggle ? 'animate-wiggle' : '']"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 21 21"
                    >
                        <path
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.585 15.5H5.415A1.65 1.65 0 0 1 4 13a10.526 10.526 0 0 0 1.5-5.415V6.5a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v1.085c0 1.907.518 3.78 1.5 5.415a1.65 1.65 0 0 1-1.415 2.5zm1.915-11c-.267-.934-.6-1.6-1-2s-1.066-.733-2-1m-10.912 3c.209-.934.512-1.6.912-2s1.096-.733 2.088-1M13 17c-.667 1-1.5 1.5-2.5 1.5S8.667 18 8 17"
                        />
                    </svg>
                    <div
                        v-if="count > 0"
                        class="absolute -top-2 -end-1 min-w-4 px-1 py-0.5 text-xs text-white rounded-full"
                        :class="badgeClass"
                    >
                        <span
                            v-if="ping"
                            class="absolute inset-0 -z-10 rounded-full animate-ping"
                            :class="pingClass"
                        ></span>
                        {{ displayCount }}
                    </div>
                </button>
            </template>

            <template #content>
                <div class="px-4 py-2 text-sm font-semibold text-gray-700 border-b border-b-gray-300">
                    Notifications
                </div>

                <div v-if="items.length" class="max-h-72 overflow-y-auto">
                    <DropdownLink
                        v-for="item in items"
                        :key="item.id"
                        as="button"
                        class="w-full text-left"
                        @click="$emit('select', item)"
                    >
                        <div class="py-2">
                            <p class="text-sm font-medium">
                                {{ item.title }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ item.time }}
                            </p>
                        </div>
                    </DropdownLink>
                </div>

                <div v-else class="px-4 py-4 text-center text-sm text-gray-500">
                    No notifications
                </div>
            </template>
        </Dropdown>
    </div>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'

export default {
    name: 'NotificationBell',
    components: {
        Dropdown,
        DropdownLink,
    },
    props: {
        items: {
            type: Array,
            default: () => [],
        },
        count: {
            type: Number,
            default: 0,
        },
        max: { type: Number, default: 99, }, 
        wiggle: { type: Boolean, default: true, },
        ping: { type: Boolean, default: true, }, 
        bgClass: { type: String, default: '', }, 
        iconClass: { type: String, default: 'text-teal-600', }, 
        badgeClass: { type: String, default: 'bg-red-500', }, 
        pingClass: { type: String, default: 'bg-red-200', },
    },

    computed: {
        displayCount() {
            return this.count > this.max
                ? `${this.max}+`
                : this.count
        },
    },
}
</script>