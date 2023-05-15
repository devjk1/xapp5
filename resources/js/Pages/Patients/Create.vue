<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";

const form = useForm({
    first_name: '',
    last_name: '',
});

const submit = () => {
    form.post(route('patients.store'), {
        preserveScroll: true,
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Patients Create">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1 class="text-xl font-medium">
                        Patients Create
                    </h1>

                    <form @submit.prevent="submit()"
                          class="mt-4"
                    >
                        <div>
                            <InputLabel for="first_name" value="First Name" />
                            <TextInput
                                id="first_name"
                                v-model="form.first_name"
                                type="text"
                                required
                                autofocus
                                autocomplete="first_name"
                            />
                            <InputError :message="form.errors.first_name" />
                        </div>
                        <div class="mt-2">
                            <InputLabel for="last_name" value="Last Name" />
                            <TextInput
                                id="last_name"
                                v-model="form.last_name"
                                type="text"
                                required
                                autocomplete="last_name"
                            />
                            <InputError :message="form.errors.last_name" />
                        </div>
                        <button type="submit"
                                :disabled="form.processing"
                                class="mt-4 px-3 py-1 text-white bg-gray-600 hover:bg-gray-500 rounded-lg"
                                :class="[ form.processing ? 'opacity-25' : '' ]"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
