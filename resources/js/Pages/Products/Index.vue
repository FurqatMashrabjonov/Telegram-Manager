<template>
    <Head title="Categories"/>

    <AuthenticatedLayout>
        <template #header>
            Products
            <Link :href="route('products.create')"
                  class="rounded-lg border border-transparent bg-purple-600 px-4 py-1 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600">
                Add product
            </Link>
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">

            <flash v-show="$page.props.flash.success" :message="$page.props.flash.success"/>

            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <div class="overflow-x-auto w-full">

                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                        <tr v-for="product in products.data" :key="product.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                Image
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ product.name }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ product.price }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ product.category ? product.category.name : 'yoq' }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <status :status="product.status"/>
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <box-icon name='trash' color='#fb0000' class="cp"
                                          @click="destroy(product.id)"></box-icon>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    <pagination :links="products.links"/>
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
import { Link } from '@inertiajs/inertia-vue3';
import Flash from "@/Components/Flash.vue";
import {useForm} from '@inertiajs/inertia-vue3'
import {inject} from 'vue'

let swal = inject('$swal')
const props = defineProps({
    products: Object,
})

function destroy(id) {
    const form = useForm();
    swal.fire({
        title: 'Do you want to delete?',
        showCancelButton: true,
        confirmButtonText: 'Ok',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('products.delete', id));
        }
    })
}


</script>


<style>
.cp {
    cursor: pointer;
}
</style>
