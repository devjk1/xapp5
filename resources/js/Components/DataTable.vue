<script setup>
const props = defineProps({
    data: {
        type: Array,
        required: true,
    },
    headers: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <table class="table-auto w-full mt-2">
        <thead class="border-b-2">
            <tr>
                <th v-for="(header, index) in headers" :key="header.id"
                    class="text-left"
                >
                    {{ header }}
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="(item, index) in data" :key="item.id">
                <slot name="row" :item="item" :index="index"></slot>
            </tr>
        </tbody>
    </table>
</template>
