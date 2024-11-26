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
    },
    product: Object
});

const form = useForm({
    title: props.product.data.title ?? '',
    description: props.product.data.description ?? '',
    price: props.product.data.price ?? 0,
    category_id: props.product.data.category?.id ?? '',
});

const submit = () => {
    form.put(route('admin.products.update', props.product.data.id))
};
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Edit Product" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Product
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
                            <SelectInput v-model="form.category_id" required class="block w-full">
                                <option value="">Select Category</option>
                                <option :value="category.id" v-for="category of categories">{{ category.name }}
                                </option>
                            </SelectInput>
                            <InputError :message="form.errors.category_id" />
                        </div>

                        <div>
                            <InputLabel>Category</InputLabel>
                            <TextAreaInput v-model="form.description" placeholder="Description" maxlength="255" rows="2"
                                class="block w-full resize-none" />
                            <InputError :message="form.errors.category_id" />
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
