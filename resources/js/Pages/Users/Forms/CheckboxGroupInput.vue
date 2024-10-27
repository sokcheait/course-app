<template>
    <div class="">
        <div v-for="option in options" :key="option.value" class="">
            <input
                :type="type"
                :value="option.value"
                :id="option.value"
                v-model="checkboxValues"
                @change="updateValue"
                class="w-6 h-6 border-2 m-2 rounded-md"
            /> 
            <label :for="option.value" class="ml-2">{{ option.label }}</label>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CheckboxGroupInput',
    props: {
        value: {
            type: Array,
            default: () => []
        },
        options: {
            type: Array,
            required: true
        },
        type: {
            type: String,
            default: 'checkbox'
        }
    },
    data() {
        return {
            checkboxValues: this.value // Initial checkbox state
        };
    },
    methods: {
        updateValue() {
            this.$emit('update:modelValue', this.checkboxValues);
        }
    },
    watch: {
        value(newVal) {
            this.checkboxValues = newVal; // Sync external value with internal state
        }
    }
};
</script>
<style>
    /* Custom styles for the tick mark */
    .tick {
        display: none;
        color: white; /* Color of the tick mark */
        font-size: 1.25rem; /* Size of the tick mark */
    }
    /* Show tick when radio is checked */
    input[type="radio"]:checked + span .tick {
        display: block;
    }
</style>
