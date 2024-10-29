<template>
    <div class="grid grid-cols-3">
      <div v-for="(fields, fieldsIndex) in initialTableData" :key="fieldsIndex" class="mb-4">
        <div v-for="items,itemsIndex in fields" :key="itemsIndex">
            <label class="block border p-2">{{ itemsIndex }}</label>
            <div v-for="(input, inputIndex) in items" :key="inputIndex" class="flex items-center">
                <input
                    :type="input.type"
                    :name="input.name"
                    v-model="dataInput[input.name]"
                    class="border p-2 w-full"
                    placeholder="Enter value..."
                    @input="updateValue(input.name, input.value)"
                />
            </div>
        </div>
        
      </div>
    </div>
</template>
  
<script>
  export default {
    name: 'DynamicInput',
    props: {
        initialTableData: {
            type: Array,
            required: true,
        },
        valueDefault: {
            type: Object,
            default: () => ({}),
        },
        // dataInput: {
        //     type: Array,
        //     default: () => [],
        // },
        modelValue: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            dataInput:{...this.modelValue}
        };
    },
    methods: {
        updateValue(key, value) {
            this.dataInput[key]=value;
            this.$emit('update:modelValue', this.dataInput);
        },
    },
    watch: {
        modelValue: {
            handler(newValue) {
                this.dataInput = { ...newValue }; // Watch for prop changes
            },
            deep: true
        }
    }
  };
</script>
  