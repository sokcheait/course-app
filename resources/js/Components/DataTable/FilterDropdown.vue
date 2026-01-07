<template>
    <div class="relative pr-2" ref="wrapper">
        <button
        @click="open = !open"
        class="inline-flex items-center h-8 pl-2.5 pr-2 rounded-md shadow
                text-gray-700 dark:text-gray-400 dark:border-gray-800
                border border-gray-200 leading-none py-0"
        >
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
        <div
        v-if="open"
        class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800
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
import { ref, computed, watch } from 'vue'

const props = defineProps({
    label: {
        type: String,
        default: 'Filter by',
    },
    options: {
        type: Array,
        required: true, // [{ label: 'All', value: null }, ...]
    },
    modelValue: {
        default: null, // v-model binding
    },
})

const emit = defineEmits(['update:modelValue'])
const open = ref(false)

// Reactive computed label
const currentLabel = computed(() => {
    const selected = props.options.find(o => o.value === props.modelValue)
    return selected ? selected.label : props.label
})

const select = (value) => {
    emit('update:modelValue', value)
    open.value = false
}
</script>