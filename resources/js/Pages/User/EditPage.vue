<script setup lang="ts">

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UserForm from "@/Pages/User/Partial/Form.vue";
import {Head} from "@inertiajs/vue3";

interface User {
    id: number
    firstName: string
    lastName: string
    email: string
    role: string
}

interface Role {
    label: string
    value: string
}

const props = defineProps<{
    user: User,
    roles: Role[]
}>()
</script>

<template>
    <Head title="Edit User" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <UserForm
                        :id="props.user.id"
                        :role="props.user.role"
                        :first-name="props.user.firstName"
                        :last-name="props.user.lastName"
                        :email="props.user.email"
                        :roles="props.roles"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
