<template>
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
        <div class="py-4 text-gray-500">
            <Link class="ml-6 text-lg font-bold text-gray-800" :href="route('dashboard')">
                Windmill
            </Link>

            <ul class="mt-6">
                <li class="relative px-6 py-3">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </template>
                        Dashboard
                    </NavLink>
                </li>

                <li class="relative px-6 py-3">
                    <NavLink :href="route('telegram_users.index')" :active="route().current('telegram_users.index')">
                        <template #icon>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </template>
                        Users
                    </NavLink>
                </li>

                <li class="relative px-6 py-3">
                    <NavLink :href="route('categories.index')" :active="route().current('categories.index')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                            </svg>
                        </template>
                        Categories
                    </NavLink>
                </li>

                <li class="relative px-6 py-3">
                    <NavLink :href="route('products.index')" :active="route().current('products.index')">
                        <template #icon>
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                            </svg>
                        </template>
                        Products
                    </NavLink>
                </li>

            </ul>
        </div>
    </aside>
</template>

<script>
import NavLink from '@/Components/NavLink.vue'
import {Link} from '@inertiajs/inertia-vue3';
import {ref} from 'vue'

export default {
    components: {
        NavLink,
        Link,
    },

    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu
        }
    },
}
</script>
