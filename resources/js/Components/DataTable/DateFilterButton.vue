<template>
    <div class="relative pr-2" ref="wrapper">
        <!-- Button -->
        <button
        @click="open = !open"
        class="inline-flex items-center h-8 pl-2.5 pr-2 rounded-md shadow
                text-gray-700 dark:text-gray-400 dark:border-gray-800
                border border-gray-200 leading-none py-0"
        >
        <svg
            viewBox="0 0 24 24"
            class="w-4 mr-2 text-gray-400 dark:text-gray-600"
            stroke="currentColor"
            stroke-width="2"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>

        {{ currentLabel }}

        <svg
            viewBox="0 0 24 24"
            class="w-4 ml-1.5 text-gray-400 dark:text-gray-600"
            stroke="currentColor"
            stroke-width="2"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
        </button>

        <!-- Dropdown -->
        <div
        v-if="open"
        class="absolute right-0 mt-2 w-44 bg-white dark:bg-gray-800
                border border-gray-200 dark:border-gray-700
                rounded shadow z-20"
        >
        <button
            v-for="option in options"
            :key="option.value"
            @click="select(option.value)"
            class="block w-full px-3 py-2 text-left
                hover:bg-gray-100 dark:hover:bg-gray-700"
        >
            {{ option.label }}
        </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    label: {
        type: String,
        default: 'Last 30 days',
    },
    options: {
        type: Array,
        required: true,
        // example: [{ label: 'Last 7 days', value: '7' }, { label: 'Last 30 days', value: '30' }]
    },
    modelValue: {
        default: null, // v-model binding
    },
})

const emit = defineEmits(['update:modelValue'])
const open = ref(false)

// Show selected option label on button
const currentLabel = computed(() => {
    const selected = props.options.find(o => o.value === props.modelValue)
    return selected ? selected.label : props.label
})

const select = (value) => {
    emit('update:modelValue', value)
    open.value = false
}
</script>