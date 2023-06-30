<script setup>
const props = defineProps({
    medicationSearch: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <input
        :value="medicationSearch"
        @input="$emit('searchMedications', $event.target.value)"
        class="p-2 border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    >
</template>
