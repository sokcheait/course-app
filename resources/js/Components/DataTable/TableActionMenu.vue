<template>
    <div class="relative inline-block text-left">
        <button
            @click="toggle"
            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 text-gray-600 dark:text-gray-300"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6v.01M12 12v.01M12 18v.01"
                />
            </svg>
        </button>

        <!-- Dropdown -->
        <div
            v-if="open"
            class="absolute right-0 z-50 mt-2 w-40 rounded-md shadow-lg
                   bg-white dark:bg-gray-900
                   ring-1 ring-black ring-opacity-5"
        >
            <div class="py-1">
                <slot :item="item" :close="close" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TableActionMenu',
    props: {
        item: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            open: false,
        }
    },

    methods: {
        toggle() {
            this.open = !this.open
        },
        close() {
            this.open = false
        },
    },
}
</script>