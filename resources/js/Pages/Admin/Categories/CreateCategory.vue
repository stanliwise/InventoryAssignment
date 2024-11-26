<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: '',
    discount_value: 0
});

const submit = () => {
    form.post(route('admin.categories.store'))
};
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Create Category" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Category
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit"
                        class="max-w-md mx-auto px-6 py-10 shadow-sm rounded-lg flex flex-col space-y-6">
                        <div>
                            <InputLabel>Name</InputLabel>
                            <TextInput v-model="form.name" required placeholder="Name" maxlength="255"
                                class="block w-full" />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel>Discount</InputLabel>
                            <TextInput v-model="form.discount_value" placeholder="Discount" min="0" max="100" steps="0.01"
                                type="number" class="block w-full" />
                            <InputError :message="form.errors.discount_value" />
                        </div>

                        <div>
                            <PrimaryButton :disabled="form.processing" type="submit">
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
