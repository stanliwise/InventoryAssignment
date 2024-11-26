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
    categories: {
        type: Array,
        default: () => []
    },
    products: {
        type: Array,
        default: () => []
    }
});

const filters = ref({
    category_id: route().params.filters?.category_id ?? '',
    page: parseInt(route().params.page ?? 1)
});

const getData = async () => {
    router.get(route(route().current(), {
        page: filters.value.page,
        filters: filters.value.category_id
            ? {category_id: filters.value.category_id}
            : null
    }));
}

const headers = [
    { name: "Title", key: "title" },
    { name: "Price", key: "price" },
    { name: "Category", key: "category_id" },
    { name: "Description", key: "description" },
    { name: "Date Added", key: "created_at" },
    { name: "Action", key: "action" },
];


watch(filters, () => {
    getData();
}, { deep: true });
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Products" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div
                        class="flex items-center justify-between px-6 py-3 border-b border-gray-200 sm:flex-row sm:items-center sm:justify-between sm:px-10">
                        <div class="flex items-center">
                            <Link :href="route('admin.products.create')"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">
                            Add New Product
                            </Link>
                        </div>
                        <div class="flex items-center">
                            <SelectInput v-model="filters.category_id">
                                <option value="">All Categories</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </SelectInput>
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
                            <tr v-for="product in products.data" :key="product.id">
                                <td class="px-4 py-3">{{ product.title }}</td>
                                <td class="px-4 py-3">{{ product.price }}</td>
                                <td class="px-4 py-3">{{ product.category?.name }}</td>
                                <td class="px-4 py-3">{{ product.description }}</td>
                                <td class="px-4 py-3">{{ new Date(product.created_at).toDateString()}}</td>
                                <td class="px-4 py-3">
                                    <div class="inline-flex items-center gap-4">
                                        <Link :href="route('admin.products.edit', product)"
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
