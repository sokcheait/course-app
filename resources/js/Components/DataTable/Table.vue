<template>
    <div class="overflow-y-auto h-[500px]">
        <table class="w-full text-left border-collapse">
            <thead class="sticky top-0 bg-white dark:bg-gray-900 z-5">
                <tr class="text-gray-600">
                    <th
                        v-for="(column, idx) in columns"
                        :key="idx"
                        class="font-normal px-3 pt-0 pb-3 border-b border-gray-200 dark:border-gray-800"
                        :class="column.hidden ? 'hidden md:table-cell' : ''"
                    >
                        {{ column.label }}
                    </th>
                </tr>
            </thead>

            <tbody class="text-gray-600 dark:text-gray-100">
                <tr v-for="(item, index) in items.data" :key="index">
                    <td
                        v-for="(column, cIndex) in columns"
                        :key="cIndex"
                        class="sm:p-3 py-2 px-1 border-b border-gray-200 dark:border-gray-800"
                        :class="column.hidden ? 'hidden md:table-cell' : ''"
                    >
                        <slot
                        v-if="column.slot"
                        :name="column.slot"
                        :item="item"
                        />
                        <div v-else>
                        {{ item[column.field] }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Table",
    props: {
        items: {
            type: Object,
            default: () => ({ data: [] }),
        },
        columns: {
            type: Array,
            required: true,
        },
    },
};
</script>