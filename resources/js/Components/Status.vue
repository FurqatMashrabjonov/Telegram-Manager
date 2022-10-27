<template>
    <span v-if="status === 0"
          class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Inactive</span>
    <span v-if="status === 1"
          class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Active</span>
</template>

<script setup>
defineProps({
    status: Number,
});
</script>

<style scoped>

</style>
