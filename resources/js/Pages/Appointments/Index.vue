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
    <AppLayout title="Appointments Index">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between">
                        <h1 class="text-xl font-medium">
                            Appointments Index
                        </h1>
                        <Link
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
                            <th class="text-center">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(appointment, index) in appointments" :key="appointment.id">
                            <td class="">{{ appointment.id }}</td>
                            <td class="">{{ `${appointment.scheduled_for.last_name}, ${appointment.scheduled_for.first_name}` }}</td>
                            <td class="">{{ `${appointment.incident.patient.last_name}, ${appointment.incident.patient.first_name}` }}</td>
                            <td class="">{{ appointment.start }}</td>
                            <td class="">{{ appointment.end }}</td>
                            <td class="">
                                <div class="flex justify-center items-center space-x-4">
                                    <Link>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </Link>
                                    <Link>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </Link>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                    <Link :href="route('appointments.show', { appointment: appointment.id })"
                                          as="button"
                                          class="px-2 py-1 text-white bg-gray-500 hover:bg-gray-400 rounded-md"
                                    >
                                        Select
                                    </Link>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
