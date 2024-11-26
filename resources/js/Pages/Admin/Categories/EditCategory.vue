<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/components/TextInput.vue';
import InputLabel from '@/components/InputLabel.vue';
import InputError from '@/components/InputError.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';

const props = defineProps({
    category: Object
})

const form = useForm({
    title: props.category.title ?? '',
    discount: props.category.discount ?? 0
});

const submit = () => {
    form.put(route('admin.categories.update', props.category))
};
</script>
<template>
    <AuthenticatedLayout>

        <Head title="Edit Category" />
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Category
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
                            <InputLabel>Discount</InputLabel>
                            <TextInput v-model="form.discount" placeholder="Discount" min="0" max="100" steps="0.01"
                                type="number" class="block w-full" />
                            <InputError :message="form.errors.discount" />
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
