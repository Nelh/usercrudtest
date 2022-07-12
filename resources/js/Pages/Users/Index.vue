<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Inertia } from '@inertiajs/inertia';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref, onMounted, watch, reactive } from 'vue';
    import SearchFilter from '../../Components/SearchFilter.vue';

    const props = defineProps({
        filters: Object,
        users: Object
    })

    const form = reactive({
        search: "",
    })

    watch(form, () => {
        Inertia.get(route('users'), form, {
            preserveState: true,
            replace: true,
        })
    });
</script>

<template>
    <Head title="Users" />
    
    <BreezeAuthenticatedLayout>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-xl font-bold text-slate-800 my-2">User Management</div>
                <div class="flex flex-col justify-between space-y-4 border-b border-gray-200 py-3 md:flex-row md:items-center md:space-x-10 md:space-y-0">
                    <div class="max-w-full space-y-0.5">
                        <!-- <span class="text-md text-slate-800 font-bold">User Management</span> -->
                        <SearchFilter 
                            class="mr-4 w-full max-w-md" 
                            v-model="form.search"
                        />
                    </div>
                    <div class="flex items-center">
                        <Link :href="route('users.create')" class="inline-flex items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-800 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-900 disabled:opacity-25 transition">Add User</Link>
                    </div>
                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                        User name
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                        User Email
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="users.length > 0">
                                <tr v-for="user in users" :key="user.id">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <p class="text-slate-900 whitespace-no-wrap">
                                            {{ user.name }}
                                        </p>
                                    </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-slate-900 whitespace-no-wrap">
                                        {{ user.email }}
                                    </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <Link :href="route('users.edit', { id: user.id })" class="inline-flex w-auto shrink-0 cursor-pointer select-none appearance-none items-center justify-center space-x-2 rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-slate-800 transition hover:border-gray-300 hover:bg-gray-100 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-lg">
                                            <span class="shrink-0">Edit</span>
                                        </Link>
                                        <Link :href="route('users.destroy', { id: user.id })" method="delete" as="button" class="ml-2 inline-flex w-auto shrink-0 cursor-pointer select-none appearance-none items-center justify-center space-x-2 rounded border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-slate-800 transition hover:border-gray-300 hover:bg-gray-100 focus:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-lg">
                                            <span class="shrink-0">Delete</span>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
