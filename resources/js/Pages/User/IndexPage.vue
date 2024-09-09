<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import Swal from "sweetalert2";

interface User {
    id: number
    firstName: string
    lastName: string
    email: string
    role: string
}

const props = defineProps<{
    users: User[]
}>()

const deleteUser = (id: number) => {
    router.delete(route('users.delete', {user: id}), {
        onSuccess: () => {
            Swal.fire({
                title: 'Success!',
                text: 'User Deleted Successfully',
                icon: 'success',
            })
        }
    })
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-20 py-10">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold">Users List</h3>
                        <Link :href="route('users.create')" class="bg-blue-600 text-white px-4 py-2 rounded-md">Create User</Link>
                    </div>
                    <hr class="mt-4">
                    <div class="mt-10">
                        <ul v-if="props.users.length > 0">
                            <li v-for="user in props.users" class="flex justify-between items-center my-2">
                                <div class="flex flex-col">
                                    <p class="text-sm font-bold">{{user.firstName.toUpperCase()}} {{ user.lastName.toUpperCase() }}</p>
                                    <p class="text-xs flex gap-1 items-center">
                                        <span>{{user.email}}</span>
                                        <span class="bg-gray-200 w-fit px-2 py-0.5 rounded-md">{{user.role}}</span>
                                    </p>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <Link :href="route('users.edit', {user: user.id})" class="bg-gray-400 text-white px-4 py-2 rounded-md">Edit</Link>
                                    <button @click="deleteUser(user.id)" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                                </div>
                            </li>
                        </ul>
                        <p v-else>No users.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
