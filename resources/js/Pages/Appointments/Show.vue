<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {onBeforeMount, onBeforeUpdate, ref, watch} from "vue";
import SearchInput from "../../Components/SearchInput.vue";
import DataTable from "../../Components/DataTable.vue";

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
const complaintsList = ref([]);
const initComplaintsList = () => {
    props.complaints.data.forEach(complaint => {
        complaintsList.value.push({
            id: complaint.id,
            name: complaint.name,
            level: "0",
        });
    });
};
const saveComplaints = () =>  {
    form.complaints = [];
    form.complaints = complaintsList.value.filter(complaint => complaint.level > 0);
    page.value = 2;
};
const search = ref({
    medication: "",
});
const searchMedications = async (searchValue) => {
    await router.reload({
        data: {
            search_medication: searchValue,
        },
        only: ["medications"],
    });
};
const medicationsList = ref([]);
const initMedicationsList = () => {
    medicationsList.value = [];
    props.medications.data.forEach(medication => {
        medicationsList.value.push({
            id: medication.id,
            name: medication.name,
            quantity: 0,
        });
    });
};
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
const complaintsTableHeaders = ref([
    "Complaint",
    "Level",
]);
const medicationsTableHeaders = ref([
    "ID",
    "Name",
    "Quantity",
]);

const submit = () => {
    addMedicationsToCart();
    form.medications = medicationsCart.value;
    form.post(route('invoices.store', { appointment: props.appointment.data.id }), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};
onBeforeMount(() => {
    initComplaintsList();
    initMedicationsList();
});
onBeforeUpdate(() => {
    initMedicationsList();
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
                    <div v-show="page === 1">
                        <DataTable
                            :data="complaints.data"
                            :headers="complaintsTableHeaders"
                        >
                            <template #row="rowProps">
                                <td>{{ rowProps.item.name }}</td>
                                <td>
                                    <input type="range"
                                           min="0"
                                           max="5"
                                           v-model="complaintsList[rowProps.index].level"
                                    >
                                </td>
                            </template>
                        </DataTable>

                        <div class="flex justify-end">
                            <PrimaryButton
                                @click="saveComplaints"
                            >
                                Save Complaints
                            </PrimaryButton>
                        </div>
                    </div>

                    <div v-show="page === 2">
                        <div class="mt-4 flex justify-between">
                            <SearchInput
                                v-model="search.medication"
                                @update:modelValue="searchMedications"
                            />
                            <PrimaryButton
                                @click="addMedicationsToCart()"
                            >
                                Add to Cart
                            </PrimaryButton>
                        </div>
    <!--                    Medications List-->
                        <div>
                            <DataTable
                                :data="medications.data"
                                :headers="medicationsTableHeaders"
                            >
                                <template #row="rowProps">
                                    <td>{{ rowProps.item.id }}</td>
                                    <td>{{ rowProps.item.name }}</td>
                                    <input type="number"
                                           v-model="medicationsList[rowProps.index].quantity"
                                           min="0"
                                    >
                                </template>
                            </DataTable>
                        </div>
<!--                        Submit-->
                        <div class="flex justify-end">
                            <PrimaryButton
                                @click="submit"
                            >
                                Submit
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
