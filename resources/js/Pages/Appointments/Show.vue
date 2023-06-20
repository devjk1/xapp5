<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {ref} from "vue";

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
const page = ref(1);
const baseForm = {
    complaints: [],
};
props.complaints.data.forEach(complaint => {
    baseForm["complaints"][complaint.id] = "0";
})
const form = useForm("Appointments/Show", {
    ...baseForm,
});

const submit = () => {
    form.post(route('appointment.complaints.store', { appointment: props.appointment.data.id }), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};
const prevPage = () => {
    if (page.value > 0) {
        page.value--;
    }
};
const nextPage = () => {
    if (page.value < 4) {
        page.value++;
    }
};
</script>

<template>
    <AppLayout title="Appointments Show">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
<!--                    Top Nav-->
                    <div class="flex space-x-2">
                        <PrimaryButton
                            @click="page = 1"
                        >
                            Checklist
                        </PrimaryButton>
                        <PrimaryButton
                            @click="page = 2"
                        >
                            Medications
                        </PrimaryButton>
                        <PrimaryButton
                            @click="page = 3"
                        >
                            Products
                        </PrimaryButton>
                        <PrimaryButton
                            @click="page = 4"
                        >
                            Prescriptions
                        </PrimaryButton>
                    </div>
<!--                    Content-->
                    <form @submit.prevent="submit()">
                        <div v-show="page === 1">
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
                        </div>
                    </form>
                    <div v-show="page === 2">
                        Page 2
                    </div>
                    <div v-show="page === 3">
                        Page 3
                    </div>
                    <div v-show="page === 4">
                        Page 4
                    </div>
                    <div class="flex justify-end" v-show="page === 1">
                        <PrimaryButton
                            @click="nextPage()"
                            class="mt-4"
                        >
                            Next
                        </PrimaryButton>
                    </div>
<!--                    Prev/Next Buttons-->
                    <div class="flex justify-between" v-show="page > 1">
                        <PrimaryButton
                            @click="prevPage()"
                            v-show="page > 1 && page <= 4"
                            class="mt-4"
                        >
                            Previous
                        </PrimaryButton>
                        <PrimaryButton
                            @click="nextPage()"
                            v-show="page < 4"
                            class="mt-4"
                        >
                            Next
                        </PrimaryButton>
                        <PrimaryButton
                            @click="submit()"
                            v-show="page === 4"
                            :disabled="form.processing"
                            class="mt-4"
                            :class="[ form.processing ? 'opacity-25' : '' ]"
                        >
                            Submit
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
