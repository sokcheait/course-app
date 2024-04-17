<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Role
            </h2>
            <div class="flex">
                <div class="border bg-teal-600 px-4 py-2">
                    <a :href="this.route('roles.create')" class="text-sm text-white">Create Role</a>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    Hello Role
                </div>
            </div>
        </div>
    </AppLayout>
</template>