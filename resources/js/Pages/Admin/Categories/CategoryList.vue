<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import TextInput from '@/components/TextInput.vue';
import InputLabel from '@/components/InputLabel.vue';
import InputError from '@/components/InputError.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SelectInput from '@/components/SelectInput.vue';
import TextAreaInput from '@/components/TextAreaInput.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    categories: Object
});

const filters = ref({
    page: parseInt(route().params.page ?? 1)
});

const getData = async () => {
    router.get(route(route().current, filters.value));
}

const headers = [
    { name: "Title", key: "title" },
    { name: "Discount", key: "discount_value" },
    { name: "Date Added", key: "created_at" },
    { name: "Action", key: "action" },
];


watch(filters, () => {
    getData();
}, { deep: true });
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Categories" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div
                        class="flex items-center justify-end mb-6 px-6 py-3 border-b border-gray-200 sm:flex-row sm:items-center sm:justify-between sm:px-10 ">
                        <div class="flex items-center justify-end">
                            <Link :href="route('admin.categories.create')"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">
                            Add Category
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
                            <tr v-for="category of categories.data" :key="category.id">
                                <td class="px-4 py-3">{{ category.title }}</td>
                                <td class="px-4 py-3">{{ category.discount_value }}</td>
                                <td class="px-4 py-3">{{ new Date(category.created_at).toDateString() }}</td>
                                <td class="px-4 py-3">
                                    <div class="inline-flex items-center gap-4">
                                        <Link :href="route('admin.categories.edit', category.id)"
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
