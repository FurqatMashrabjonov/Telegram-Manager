<template>
    <Head title="Create Product"/>

    <AuthenticatedLayout>
        <template #header>
            Create Product
        </template>
        <div class="p-4 bg-white rounded-lg shadow-xs">

            <flash v-show="$page.props.flash.success" :message="$page.props.flash.success"/>


            <form @submit.prevent="submit">
                <div class="mt-4">
                    <InputLabel for="name" value="Name"/>
                    <TextInput id="name" type="text" class="block mt-1 w-full" v-model="form.name" required/>
                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="category" value="Category"/>
                    <select v-model="form.category_id"
                            class="mt-1 border-gray-300 rounded-md shadow-sm  focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"
                    >
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.category_id"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="price" value="Price"/>
                    <TextInput id="price" step="0.01" type="number" class="block mt-1 w-full" v-model="form.price" required/>
                    <InputError class="mt-2" :message="form.errors.price"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="description" value="Description"/>
                    <textarea id="description" class="block mt-1 w-full" v-model="form.description"/>
                    <InputError class="mt-2" :message="form.errors.description"/>
                </div>

                <PrimaryButton class="block mt-4 w-full" :class="{ 'opacity-25': form.processing }"
                               :disabled="form.processing">
                    Create
                </PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';

const props = defineProps({
    categories: Array,
    success: String
})

const form = useForm({
    name: '',
    description: '',
    price: 0,
    category_id: 1
});

const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => form.reset('password', 'password_confirmation'),
        onError: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
