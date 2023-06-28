<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {onBeforeMount, onBeforeUpdate, ref, watch} from "vue";
import ComplaintsForm from "./Show/ComplaintsForm.vue";

const props = defineProps({
    appointment: {
        type: Object,
        required: true,
    },
    complaints: {
        type: Object,
        required: true,
    },
    medications: {
        type: Object,
        required: true,
    }
});
const page = ref(1);
const form = useForm({
    complaints: [],
    medications: [],
});
const saveComplaints = (complaintsList) =>  {
    form.complaints = [];
    complaintsList.forEach(complaint => {
        if (complaint.level > 0) {
            form.complaints.push(complaint);
        }
    });
};
const medicationsList = ref([]);
const setMedicationsList = (medications) => {
    medicationsList.value = [];
    medications.forEach(medication => {
        medicationsList.value.push({
            id: medication.id,
            name: medication.name,
            quantity: 0,
        });
    });
};

const search = ref({
    medication: "",
});
const searchMedications = async (searchValue) => {
    const { medication } = searchValue;
    await router.reload({
        data: {
            search_medication: medication,
        },
        only: ["medications"],
    });
};
watch(search.value, (value) => {
    searchMedications(value);
});
const medicationsCart = ref([]);
const addMedicationsToCart = () => {
    medicationsList.value.forEach(medication => {
        if (medication.quantity > 0) {
            medicationsCart.value.push({
                id: medication.id,
                name: medication.name,
                quantity: medication.quantity,
            });
            medication.quantity = 0;
        }
    });
};

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
onBeforeMount(() => {
    setMedicationsList(props.medications.data);
});
onBeforeUpdate(() => {
    setMedicationsList(props.medications.data);
});
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
                    <ComplaintsForm
                        :complaints="complaints"
                        @save-complaints="saveComplaints"
                        v-show="page === 1"
                    />

                    <div v-show="page === 2">
<!--                        search-->
                        <div class="mt-4 flex justify-between space-x-4">
                            <input
                                v-model="search.medication"
                                class="p-2 border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            >
                            <PrimaryButton
                                @click="addMedicationsToCart()"
                            >
                                Add to Cart
                            </PrimaryButton>
                        </div>
<!--                        results-->
                        <div>
                            <table class="table-auto w-full mt-2">
                                <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(medication, index) in medicationsList" :key="medication.id">
                                    <td>{{ medication.name }}</td>
                                    <td>
                                        <input type="number"
                                               v-model="medicationsList[index].quantity"
                                               min="0"
                                        >
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
