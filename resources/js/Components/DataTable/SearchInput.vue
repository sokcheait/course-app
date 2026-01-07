<template>
    <div class="relative">
        <input
            type="text"
            v-model="model"
            @input="onInput"
            :placeholder="placeholder"
            class="border px-3 py-1 rounded w-full border-gray-300 sm:w-80"
        />
        <svg
            viewBox="0 0 24 24"
            class="w-4 h-4 absolute right-2 top-1/2 -translate-y-1/2 text-gray-400"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <circle cx="11" cy="11" r="8"></circle> 
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    modelValue: String,
    placeholder: {
        type: String,
        default: 'Search...',
    },
})

const emit = defineEmits(['update:modelValue'])
const model = ref(props.modelValue || '')

const onInput = () => {
    emit('update:modelValue', model.value)
}

watch(() => props.modelValue, (val) => {
    model.value = val
})
</script>