<script setup lang="ts">

import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm, Link, router} from "@inertiajs/vue3";
import Swal from "sweetalert2";

interface Role {
    label: string
    value: string
}

const props = defineProps<{
    id?: number,
    firstName?: string,
    lastName?: string,
    email?: string,
    role?: string,
    roles: Role[],
}>()

const submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            Swal.fire({
                title: 'Success!',
                text: `${props.id ? 'User Updated Successfully' : 'User Created Successfully'}`,
                icon: 'success',
            })

            router.visit(route('dashboard'));
        }
    })
}

const form = useForm({
    id: props.id ?? null,
    firstName: props.firstName ?? '',
    lastName: props.lastName ?? '',
    email: props.email ?? '',
    password: '',
    password_confirmation: '',
    role: props.role ?? '',
});
</script>

<template>
    <form @submit.prevent="submit" class="px-20 py-10">
        <div>
            <InputLabel for="firstName" value="First Name" />

            <TextInput
                id="firstName"
                type="text"
                class="mt-1 block w-full"
                v-model="form.firstName"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.firstName" />
        </div>

        <div>
            <InputLabel for="lastName" value="Last Name" />

            <TextInput
                id="lastName"
                type="text"
                class="mt-1 block w-full"
                v-model="form.lastName"
                required
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.lastName" />
        </div>

        <div class="mt-4">
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel for="password" value="Password" />

            <TextInput
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirm Password" />

            <TextInput
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>

        <div class="mt-4">
            <InputLabel for="role" value="Select Role" />
            <select v-model="form.role">
                <option v-for="role in props.roles" :value="role.value">{{role.label}}</option>
            </select>

            <InputError class="mt-2" :message="form.errors.role" />
        </div>

        <div class="flex justify-end gap-2">
            <Link :href="route('dashboard')" class="block bg-gray-400 text-white px-4 py-2 rounded-md">Back</Link>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Save</button>
        </div>
    </form>
</template>
