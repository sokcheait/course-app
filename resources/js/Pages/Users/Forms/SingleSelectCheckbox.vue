<template>
    <div class="">
        <div v-for="(option, index) in options" :key="index">
            <div class="flex flex-col w-full">
                <div v-for="(groups, idx) in option" :key="idx" class="grid grid-cols-12">
                    <div class="mx-2 col-span-10">
                        <h4 class="text-sm font-semibold mb-2">{{ idx }}</h4>
                    </div>
                    <div v-for="group ,key in groups" :key="key" class="text-end">
                        <input 
                            type="checkbox" 
                            :value="group.value" 
                            :checked="isChecked(idx,group.value)" 
                            @change="updateSelection(idx, group.value, $event)" 
                            class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        />
                        <label class="text-sm">{{ group.label }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'SingleSelectCheckbox',
    props: {
        modelValue: {
            type: Object,
            default: () => ({})
        },
        valueDefault: {
            type: Object,
            default: () => ({})
        },
        options: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            selected: { ...this.modelValue } 
        };
    },
    created() {
        // Set default values from valueDefault
        for (const key in this.valueDefault) {
            if (this.valueDefault.hasOwnProperty(key)) {
                for (const pref of this.valueDefault[key]) {
                    for (const value in pref) {
                        this.selected[value] = pref[value];
                    }
                }
            }
        }
    },
    methods: {
        isChecked(groupName, value) {
            // Check if the value exists in the selected object for the group
            return this.selected[groupName]===value;
        },
        updateSelection(groupName, value, event) {
            if (event.target.checked) {
                // Set selected value for the group
                this.selected[groupName] = value; // Direct assignment works for Vue reactivity
            } else {
                // Remove the value if unchecked
                delete this.selected[groupName]; // Use $delete to remove the property
            }
            this.$emit('update:modelValue', this.selected);
        }
    },
    watch: {
        modelValue: {
            handler(newValue) {
                this.selected = { ...newValue }; // Watch for prop changes
            },
            deep: true
        }
    }
};
</script>