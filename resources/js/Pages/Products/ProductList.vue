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
                <div class="shadow-sm sm:rounded-lg py-10 px-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xL:grid-cols-4 gap-x-6 gap-y-10">
                        <div v-for="product of products.data" :key="product.id" class="shadow-sm p-6 rounded-lg bg-white">
                            <h2 class="text-2xl font-medium mb-4">{{ product.title }}</h2>

                            <div class="flex items-center justify-between gap-6 flex-wrap">

                                <div class="flex items-center gap-4 flex-wrap">
                                    <span class="text-xs text-gray-600">Price</span>
                                    <span>${{ product.price }}</span>
                                </div>

                                <div class="flex items-center gap-4 flex-wrap">
                                    <span class="text-xs text-gray-600">Sale Price</span>
                                    <span>${{ product.sale_price }}</span>
                                </div>
                            </div>

                            <div class="my-6 text-sm text-gray-600">
                                {{ product.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
