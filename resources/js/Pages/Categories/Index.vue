<template>
    <Head title="Categories"/>

    <AuthenticatedLayout>
        <template #header>
            Categories
            <button
                class="rounded-lg border border-transparent bg-purple-600 px-4 py-1 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600"
                @click="openCreateModal"
            >
                Add category
            </button>

        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">

            <flash v-show="$page.props.flash.success" :message="$page.props.flash.success" />

            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <div class="overflow-x-auto w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                        <tr v-for="category in categories.data" :key="category.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ category.name }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <status :status="category.status"/>
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <box-icon name='trash' color='#fb0000' class="cp"
                                          @click="destroy(category.id)"></box-icon>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    <pagination :links="categories.links"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import {Head, usePage} from '@inertiajs/inertia-vue3';
import Status from "@/Components/Status.vue";
import {useForm} from '@inertiajs/inertia-vue3'


import {inject} from 'vue'
import Flash from "@/Components/Flash.vue";

let swal = inject('$swal')
const props = defineProps({
    categories: Object,
    message: String
})

function openCreateModal() {
    swal.fire({
        title: 'Create Category',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off',
            placeholder: 'Name'
        },
        showCancelButton: true,
        confirmButtonText: 'Create',
        showLoaderOnConfirm: true,
        preConfirm: (name) => {
            useForm({
                name: name
            }).post(route('categories.store'));
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url
            })
        }
    })
}

function destroy(id) {
    const form = useForm();
    swal.fire({
        title: 'Do you want to delete?',
        showCancelButton: true,
        confirmButtonText: 'Ok',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('categories.destroy', id));
        }
    })


}

</script>


<style>
.cp {
    cursor: pointer;
}
</style>
