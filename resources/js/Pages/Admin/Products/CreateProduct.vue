<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/components/TextInput.vue';
import InputLabel from '@/components/InputLabel.vue';
import InputError from '@/components/InputError.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SelectInput from '@/components/SelectInput.vue';
import TextAreaInput from '@/components/TextAreaInput.vue';

const props = defineProps({
    categories: {
        type: Array,
        default: () => []
    }
});

const form = useForm({
    title: '',
    description: '',
    price: 0,
    product_category_id: ''
});

const submit = () => {
    form.post(route('admin.products.store'))
};
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Add Product" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Add Product
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit"
                        class="max-w-md mx-auto px-6 py-10 shadow-sm rounded-lg flex flex-col space-y-6">
                        <div>
                            <InputLabel>Title</InputLabel>
                            <TextInput v-model="form.title" required placeholder="Title" maxlength="255"
                                class="block w-full" />
                            <InputError :message="form.errors.title" />
                        </div>

                        <div>
                            <InputLabel>Price</InputLabel>
                            <TextInput v-model="form.price" placeholder="Price" min="0" steps="0.01" type="number"
                                class="block w-full" />
                            <InputError :message="form.errors.price" />
                        </div>

                        <div>
                            <InputLabel>Category</InputLabel>
                            <SelectInput v-model="form.product_category_id" required class="block w-full">
                                <option value="">Select Category</option>
                                <option :value="category.id" v-for="category of categories">{{ category.title }}
                                </option>
                            </SelectInput>
                            <InputError :message="form.errors.product_category_id" />
                        </div>

                        <div>
                            <InputLabel>Description</InputLabel>
                            <TextAreaInput v-model="form.description" placeholder="Description" maxlength="255" rows="2"
                                class="block w-full resize-none" />
                            <InputError :message="form.errors.description" />
                        </div>

                        <div>
                            <PrimaryButton>
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
