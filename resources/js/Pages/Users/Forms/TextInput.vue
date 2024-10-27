<template>
    <div class="border-none">
        <VanillaInput
            v-model="model"
            :placeholder="placeholder"
            :type="type"
            :errors="errors"
            :disabled="disabled"
        />
    </div>
  </template>
  
<script>
import { Input as VanillaInput } from '@flavorly/vanilla-components'
export default {
    name:'InputText',
    components: {
        VanillaInput
    },
    props: {
        placeholder: {
            type: String,
            default: '',
        },
        modelValue: {
            type: String,
            default: '',
        },
        requirest: {
            type: String,
            default: '',
        },
        type: {
            type: String,
            default: 'text'
        },
        errors: {
            type: String,
            default: '',
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    computed:{
        model: {
            get() { return this.modelValue },
            set(newValue) { this.$emit('update:modelValue', newValue); this.$emit('clear-errors'); } 
        }
    },
}

  </script>
  
  
  