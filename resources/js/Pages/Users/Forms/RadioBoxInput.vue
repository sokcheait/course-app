<template>
    <div class="grid grid-cols-1">
        <div v-for="(option,index) in options" :key="index" class="w-full">
            <div v-for="(items,dataLable) in option" :key="dataLable" class="grid grid-cols-3">
                <div class="px-4 w-full col-span-2">
                    <span>{{ dataLable }}</span>
                </div>
                <div class="grid grid-cols-2 ">
                    <div v-for="(item,key) in items" :key="key" class="w-full my-1">
                        <label :for="`${dataLable}-${item.value}`" class="flex items-center cursor-pointer">
                            <input
                                :type="type"
                                :value="item.value"
                                :id="`${dataLable}-${item.value}`"
                                v-model="checkboxValues[dataLable]"
                                @change="updateValue(dataLable, item.value)"
                                class="hidden peer"
                            />
                            <span class="w-5 h-5 border-2 mx-2 border-gray-300 rounded-md flex items-center justify-center text-gray-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white hover:bg-blue-100 transition duration-200 ease-in-out">
                                <span class="tick">&#10003;</span>
                            </span>
                            <span>{{ item.label }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RadioBoxInput',
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
            checkboxValues:{...this.value}
        };
    },
    methods: {
        updateValue(key, value) {
            this.checkboxValues[key]=value;
            this.$emit('update:modelValue', this.checkboxValues);
        }
    },
    watch: {
        value(newVal) {
            this.checkboxValues = {...newVal}; 
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
