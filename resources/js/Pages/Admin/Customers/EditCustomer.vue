<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    customer: Object
});


const form = useForm({
    name: props.customer.name,
    email: props.customer.email,
    password: '',
    password_confirmation: '',
    discount_value: props.customer.discount_value ?? 0
});

const submit = () => {
    form.put(route('admin.customers.update', props.customer.id))
};
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Edit Customer" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Customer
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
                            <InputLabel>Email</InputLabel>
                            <TextInput v-model="form.email" required placeholder="username@example.com" maxlength="255"
                                class="block w-full" type="email" />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel>Discount</InputLabel>
                            <TextInput v-model="form.discount_value" placeholder="Discount" min="0" max="100" steps="0.01"
                                type="number" class="block w-full" />
                            <InputError :message="form.errors.discount_value" />
                        </div>

                        <div>
                            <InputLabel>Password</InputLabel>
                            <TextInput v-model="form.password" placeholder="Password" maxlength="32"
                                minlength="8" class="block w-full" type="password" />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div>
                            <InputLabel>Re-enter Password</InputLabel>
                            <TextInput v-model="form.password_confirmation" placeholder="Re-enter Password"
                                maxlength="32" minlength="8" class="block w-full" type="password" />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>

                        <div>
                            <PrimaryButton :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
