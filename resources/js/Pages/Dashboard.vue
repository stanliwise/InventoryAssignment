<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';

const { user } = usePage().props.auth;

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <template v-if="user.is_admin">
                        <div class="flex items-center gap-6 flex-wrap py-10 px-10">
                            <Link
                                :href="route('admin.products.index')"
                                class="py-10 px-6 rounded-lg shadow hover:text-gray-600 transition ease-in-out duration-150 inline-flex items-center justify-center"
                            >
                                Products
                            </Link>


                            <Link
                                :href="route('admin.categories.index')"
                                class="py-10 px-6 rounded-lg shadow hover:text-gray-600 transition ease-in-out duration-150 inline-flex items-center justify-center"
                            >
                                Categories
                            </Link>

                            <Link
                                :href="route('admin.customers.index')"
                                class="py-10 px-6 rounded-lg shadow hover:text-gray-600 transition ease-in-out duration-150 inline-flex items-center justify-center"
                            >
                                Customers
                            </Link>
                        </div>
                    </template>
                    <template v-else>

                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
