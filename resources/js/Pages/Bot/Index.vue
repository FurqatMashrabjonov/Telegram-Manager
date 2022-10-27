<template>
  <Head title="My Bot"/>

  <AuthenticatedLayout>
    <template #header>
      My Bot
    </template>
    <div class="p-4 bg-white rounded-lg shadow-xs">

      <div v-show="$page.props.flash.success"
           class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md w-1/2">
        <div class="flex items-center justify-center w-12 bg-green-500">
          <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
            </path>
          </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
          <div class="mx-3">
            <span class="font-semibold text-green-500">Success</span>
            <p class="text-sm text-gray-600">{{ $page.props.flash.success }}</p>
          </div>
        </div>
      </div>

      <form @submit.prevent="submit" class="w-1/2">
        <div class="mt-4">
          <InputLabel for="token" value="Token"/>
          <TextInput id="token" type="text" class="block mt-1 w-full" v-model="form.token" required />
          <InputError class="mt-2" :message="form.errors.token" />
        </div>

        <PrimaryButton class="block mt-4 w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Submit
        </PrimaryButton>
      </form>
<!--        <div class="mt-2">-->
<!--            <PrimaryButton class="block mt-4 w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                Submit-->
<!--            </PrimaryButton>-->
<!--        </div>-->
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';

const form = useForm({
  _method: 'PUT',
  token: usePage().props.value.bot.token,
});

const submit = () => {
  form.put(route('bot.update'), {
    onSuccess: () => form.reset('password', 'password_confirmation'),
    onError: () => form.reset('password', 'password_confirmation'),
  });
};
</script>
