<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import { ref, onMounted } from 'vue';

    const form = useForm({
        name: '',
        email: '',
    });

    const create = () => {
        form.post(route('users.store'), { 
            errorBag: 'CreateUser',
            preserveScroll: false
        });
    }
</script>

<template>
    <Head title="Create User" />

    <BreezeAuthenticatedLayout>
      <div class="pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col justify-between space-y-4 border-b border-slate-200 py-3 md:flex-row md:items-center md:space-x-10 md:space-y-0">
              <div class="max-w-full space-y-0.5">
                  <div class="flex items-center py-2 overflow-y-auto whitespace-nowrap">
                    <Link :href="route('users')" class="text-slate-600  hover:underline"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg></Link>
                    <span class="mx-5 text-slate-500">/</span>
                    <Link class="text-slate-600">Create User</Link>
                </div>
              </div>
          </div>

          <form @submit.prevent="create" class="bg-white p-8">
            <div class="pb-4 pr-6 w-full lg:w-1/2">
              <label class="block font-medium text-sm text-slate-700" for="name">Name </label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 w-full border-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    autocomplete="name"
                />
                <p class="text-sm text-red-600 mt-2" v-if="form.errors.name">{{ form.errors.name }}</p>
            </div>

            <div class="pb-4 pr-6 w-full lg:w-1/2">
                <label class="block font-medium text-sm text-slate-700" for="email">Email </label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 w-full border-slate-300 focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    autocomplete="email"
                />
                <p class="text-sm text-red-600 mt-2" v-if="form.errors.email">{{ form.errors.email }}</p>
            </div>
            <div class="flex justify-between mb-3">
                <div>
                  <button type="submit" class="inline-flex items-center px-4 py-3 bg-slate-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-800 active:bg-slate-800 focus:outline-none focus:border-slate-500 focus:ring focus:ring-slate-900 disabled:opacity-25 transition">
                    Save
                  </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </BreezeAuthenticatedLayout>
</template>