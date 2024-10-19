<template>
    <div>
        <VanillaInput
            v-model="model"
            :placeholder="placeholder"
            type="text"
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
            set(newValue) { this.$emit('update:modelValue', newValue) } 
        }
    },
}

  </script>
  
  
  