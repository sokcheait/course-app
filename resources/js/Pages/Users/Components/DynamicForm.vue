<!-- DynamicForm.vue -->
<template>
    <div class="">
      <h1 class="mb-3 text-base font-semibold">Forms</h1>
      <form @submit.prevent="submitForm">
            <div v-for="(fieldSchema, index) in formSchema" :key="index" class="w-full">
                <div v-for="(forms, dataLabel) in fieldSchema" :key="dataLabel" class="w-full">
                    <h2 class="w-full my-3">
                        <span class="text-sm font-semibold text-rose-500">{{ index+1 }}. {{ dataLabel }}</span>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 px-4">
                        <div v-for="(field,key) in forms" :key="key" class="w-full">
                            <label :for="field.name" class="text-sm font-semibold text-gray-600">
                                {{ field.label }}
                                <span v-if="field.required==true" class="text-red-500 mr-2">*</span>
                            </label>
                            <component
                                :is="field.component"
                                v-model="formValues[dataLabel][key][field.name].value"
                                :type="field.type"
                                :placeholder="field.placeholder"
                                :required="field.required"
                                :id="'field-' + key"
                                :errors="getError(dataLabel,key,field.name)" 
                                class="mt-2"
                                v-bind="field.props"
                                @clear-errors="clearError(dataLabel, key, field.name)"
                            ></component>
                        </div>
                        
                    </div>
                </div>
            </div>
        <div class="p-4">
            <button type="submit" class="py-2 px-4 border rounded-md">Submit</button>
        </div>
      </form>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '../Forms/TextInput.vue';
import CheckboxInput from '../Forms/CheckboxInput.vue';
import CheckboxGroupInput from '../Forms/CheckboxGroupInput.vue';
import RadioBoxInput from '../Forms/RadioBoxInput.vue';
  
export default {
    name: "DynamicForm",
    components: {
        TextInput,
        CheckboxInput,
        CheckboxGroupInput,
        RadioBoxInput
    },
    props: {
        formSchema: {
            type: Array,
            default:[]
        },
    },
    setup(props) {
        // Initialize form values
        const formValues = ref({});
        const errorsFromField = ref({});

        // Populate formValues structure based on formSchema
        props.formSchema.forEach(fieldSchema => {
            Object.keys(fieldSchema).forEach(key => {
                formValues.value[key] = []; // Initialize as an array
                fieldSchema[key].forEach(field => {
                    formValues.value[key].push({ 
                        [field.name]: { 
                            value: null,      // Initialize value
                            required: field.required || false  // Set required
                        }
                    });
                });
            });
        });
        const getError = (dataLabel,key,fieldName) => {
            let keyIndex = dataLabel+'.'+key+'.'+fieldName+'.value';
            return errorsFromField.value?errorsFromField.value[keyIndex]:'';
        };
        const clearError = (dataLabel, key, fieldName) => {
            let keyIndex = `${dataLabel}.${key}.${fieldName}.value`;
            if (errorsFromField.value[keyIndex]) {
                delete errorsFromField.value[keyIndex]; // Clear errors for specific field
            }
        };

        return {
            formValues,
            errorsFromField,
            getError,
            clearError,
        };
    },
    methods: {
        submitForm() {
            console.log(this.formValues)
            this.$inertia.post(route('user.store-dynamic-form'),this.formValues, {
                preserveScroll: true,
                preserveStatus: true,
                onSuccess: (res) => {
                    console.log('Form submitted successfully!');
                },
                onError: (errors) => {
                    this.errorsFromField = errors;
                },
            });
        },
    }

  };
  </script>
  