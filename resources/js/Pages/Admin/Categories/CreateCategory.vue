<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const form = useForm({
    title: ''
});

const submit = () => {
    form.post(route('admin.categories.store'))
};
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Create Category" />
        <form @submit.prevent="submit">
            <input type="text" v-model="form.title" required>
            <button type="submit">Save</button>

        </form>
    </AuthenticatedLayout>
</template>
