<template>
    <div class="flex items-center space-x-2 border-none">
        <input
            :type="type"
            v-model="model"
            class="form-checkbox rounded text-blue-600 border-gray-300 focus:ring-blue-500"
            :disabled="disabled"
        />
        <label :for="id" class="text-gray-700">{{ label }}</label>
    </div>
</template>
<script>
export default {
    name: 'CheckboxInput',
    props: {
        type: {
            type: String,
            default: 'checkbox'
        },
        model: {
            type: [Boolean, String],
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        model: {
            get() { return this.modelValue },
            set(newValue) { this.$emit('update:modelValue', newValue) }
        }
    }
}
</script>