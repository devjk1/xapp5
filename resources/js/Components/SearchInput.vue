<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
});
const emits = defineEmits([
    "update:modelValue"
]);
</script>

<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="p-2 border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    >
</template>
