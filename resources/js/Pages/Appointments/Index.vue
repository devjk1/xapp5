<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    appointments: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <AppLayout title="Appointments">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between">
                        <h1 class="text-xl font-medium">
                            Appointments Index
                        </h1>
                        <Link
                            :href="route('appointments.index')"
                            class="px-3 py-1 bg-gray-600 text-white rounded-lg hover:bg-gray-500"
                        >
                            Create Appointment
                        </Link>
                    </div>

                    <table class="table-auto mt-4 w-full">
                        <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">User</th>
                            <th class="text-left">Patient</th>
                            <th class="text-left">Start</th>
                            <th class="text-left">End</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(appointment, index) in appointments" :key="appointment.id">
                            <td class="">{{ appointment.id }}</td>
                            <td class="">{{ `${appointment.scheduled_for.last_name}, ${appointment.scheduled_for.first_name}` }}</td>
                            <td class="">{{ `${appointment.incident.patient.last_name}, ${appointment.incident.patient.first_name}` }}</td>
                            <td class="">{{ appointment.start }}</td>
                            <td class="">{{ appointment.end }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
