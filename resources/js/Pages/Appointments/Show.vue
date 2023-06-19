<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";

const props = defineProps({
    appointment: {
        type: Object,
        required: true,
    },
    complaints: {
        type: Object,
        required: true,
    },
});

const baseForm = {
    complaints: [],
};
props.complaints.data.forEach(complaint => {
    baseForm["complaints"][complaint.id] = "0";
})
const form = useForm({
    ...baseForm,
});

const submit = () => {
    form.post(route('appointment.complaints.store', { appointment: props.appointment.data.id }), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Appointments Show">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit()">
                        <table class="table-auto mt-4 w-full">
                            <thead>
                            <tr>
                                <th class="text-left">Complaint</th>
                                <th class="text-left">Level</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(complaint, index) in complaints.data" :key="complaint.id">
                                <td class="">{{ complaint.name }}</td>
                                <td class="">
                                    <input type="range"
                                           min="0"
                                           max="5"
                                           v-model="form['complaints'][complaint.id]"
                                    >
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <PrimaryButton
                            @click="submit()"
                            :disabled="form.processing"
                            class="mt-4"
                            :class="[ form.processing ? 'opacity-25' : '' ]"
                        >
                            Submit
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
