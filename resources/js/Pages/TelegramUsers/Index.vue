<template>
    <Head title="Users"/>

    <AuthenticatedLayout>
        <template #header>
            Users
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">

            <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
                <div class="overflow-x-auto w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr  class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th></th>
                            <th class="px-4 py-3">First name</th>
                            <th class="px-4 py-3">Last name</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Lang</th>
                            <th class="px-4 py-3">Registered Date</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                        <tr v-for="user in telegram_users.data" :key="user.id" class="text-gray-700">
                            <td class="text-sm ml-1">
                                <box-icon v-if="user.is_premium" name='star' type='solid' class="small"
                                          color='#0f6bda'></box-icon>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ user.first_name }}</td>
                            <td class="px-4 py-3 text-sm">{{ user.last_name }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a :href="`https://t.me/${user.username}`" target="_blank">{{ user.username }}</a>
                            </td>
                            <td class="px-4 py-3 text-lg">{{ user.flag }}</td>
                            <td class="px-4 py-3 text-sm">{{ user.created_at_for_humans }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    <pagination :links="telegram_users.links"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {computed} from "vue";

const props = defineProps({
    telegram_users: Object
})

</script>

<style scoped>
.small {
    width: 17px;
}
</style>
