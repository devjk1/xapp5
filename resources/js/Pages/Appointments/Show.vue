<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {onBeforeMount, onBeforeUpdate, ref, watch} from "vue";
import ComplaintsForm from "./Show/ComplaintsForm.vue";
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
const saveComplaints = (complaintsList) =>  {
    form.complaints = [];
    complaintsList.forEach(complaint => {
        if (complaint.level > 0) {
            form.complaints.push(complaint);
        }
    });
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
const headers = ref([
    "ID",
    "Name",
    "Quantity",
]);

const submit = () => {
    form.post(route('appointment.complaints.store', { appointment: props.appointment.data.id }), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
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
                                :headers="headers"
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
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
