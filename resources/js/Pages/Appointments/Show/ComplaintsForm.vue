<script setup>
import {onBeforeMount, ref} from "vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";

const props = defineProps({
    complaints: {
        type: Object,
        required: true,
    },
})
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

onBeforeMount(() => {
    initComplaintsList();
});
</script>

<template>
    <div>
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
                               v-model="complaintsList[index].level"
                        >
                </td>
            </tr>
            </tbody>
        </table>
        <div class="flex justify-end">
            <PrimaryButton
                @click="$emit('saveComplaints', complaintsList)"
            >
                Save Complaints
            </PrimaryButton>
        </div>
    </div>
</template>
