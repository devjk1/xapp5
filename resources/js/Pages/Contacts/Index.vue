<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";

const props = defineProps({
    contacts: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <AppLayout title="Contacts Index">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between">
                        <h1 class="text-xl font-medium">
                            Contacts Index
                        </h1>
                        <a
                            class="px-3 py-1 bg-gray-600 text-white rounded-lg hover:bg-gray-500"
                        >
                            Create Contact
                        </a>
                    </div>

                    <table class="table-fixed mt-4 w-full">
                        <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(contact, index) in contacts.data" :key="contact.id">
                            <td class="">{{ contact.id }}</td>
                            <td class="">{{ contact.email }}</td>
                            <td class="">{{ contact.phone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
