<!-- DynamicForm.vue -->
<template>
    <div>
      <h1 class="mb-3 text-base font-semibold">Forms</h1>
      <form @submit.prevent="submitForm">
            <div v-for="(fieldSchema, index) in formSchema" :key="index" class="w-full">
                <div v-for="(forms, dataLabel) in fieldSchema" :key="dataLabel" class="w-full">
                    <h2 class="w-full my-3">
                        <span class="text-sm font-semibold text-rose-500">{{ index+1 }}. {{ dataLabel }}</span>
                    </h2>
                    <div class="grid grid-cols-2 gap-4 px-4">
                        <div v-for="(field,key) in forms" :key="key" class="w-full">
                            <label :for="'field-' + key" class="">{{ field.dataLabel }}</label>
                            <component
                                :is="field.component"
                                v-model="formValues[dataLabel][key][field.name].value"
                                :type="field.type"
                                :placeholder="field.placeholder"
                                :required="field.required"
                                :id="'field-' + key"
                                :errors="getError(dataLabel,key,field.name)" 
                                class=""
                            ></component>
                            <!-- {{ errorsFromField }} -->
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
  
export default {
    name: "DynamicForm",
    components: {
        TextInput
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
                            value: '',      // Initialize value
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

        return {
            formValues,
            errorsFromField,
            getError
            // submitForm
        };
    },
    methods: {
        submitForm() {
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
  