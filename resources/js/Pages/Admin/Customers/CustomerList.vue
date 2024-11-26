<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    customers: {
        type: Array,
        default: () => []
    }
});

const filters = ref({
    page: parseInt(route().params.page ?? 1)
});

const getData = async () => {
    router.get(route(route().current, filters.value));
}

const headers = [
    { name: "Name", key: "name" },
    { name: "Email", key: "email" },
    { name: "Discount", key: "discount" },
    { name: "Date Added", key: "created_at" },
    { name: "Action", key: "action" },
];


watch(filters, () => {
    getData();
}, { deep: true });
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Customers" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Customers
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div
                        class="flex items-center justify-between px-6 py-3 border-b border-gray-200 sm:flex-row sm:items-center sm:justify-between sm:px-10">
                        <div class="flex items-center">
                            <Link :href="route('admin.customers.create')"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">
                            Add New Customer
                            </Link>
                        </div>
                    </div>
                    <table class="table w-full overflow-x-hidden">
                        <thead>
                            <tr>
                                <th v-for="header in headers" :key="header.key"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-w-normal">
                                    {{ header.name }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="customer in customers.data" :key="customer.id">
                                <td class="px-4 py-3">{{ customer.name }}</td>
                                <td class="px-4 py-3">{{ customer.email }}</td>
                                <td class="px-4 py-3">{{ customer.discount_value }}</td>
                                <td class="px-4 py-3">{{ new Date(customer.created_at).toDateString() }}</td>
                                <td class="px-4 py-3">
                                    <div class="inline-flex items-center gap-4">
                                        <Link :href="route('admin.customers.edit', customer.id)"
                                            class="text-sm font-medium text-gray-500 hover:text-gray-700">
                                        Edit
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
