<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    patients: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <AppLayout title="Patients Index">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1>Patients Index</h1>

                    <table class="table-auto mt-2">
                        <thead>
                        <tr>
                            <th class="px-2 py-1">ID</th>
                            <th class="px-2 py-1">Last Name</th>
                            <th class="px-2 py-1">First Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(patient, index) in patients.data" :key="patient.id">
                            <td class="px-2 py-1">{{ patient.id }}</td>
                            <td class="px-2 py-1">{{ patient.last_name }}</td>
                            <td class="px-2 py-1">{{ patient.first_name }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="flex justify-center items-baseline">
                        <template v-for="link in patients.links">
                            <Link :href="link.url"
                                  v-html="link.label"
                                  class="px-2"
                                  :class="[ link.active ? 'font-bold text-lg' : '' ]"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
