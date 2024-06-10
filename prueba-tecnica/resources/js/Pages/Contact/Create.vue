<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import FileInput from '@/Components/FileInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const initialValues = {
    name: "",
    phone: "",
    avatar: null,
    privacity: "private"
};

const onSelectAvatar = (e) => {

    const files = e.target.files
    if (files.length) {
        form.avatar = files[0];
    }

};

const submit=(e)=>{
    e.preventDefault();
    form.post(route('contact.store'));
}

const form = useForm(initialValues);




</script>


<template>

    <Head title="Create Contact" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Contact</h2>
                <Link :href="route('contact.create')">Contact List</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="w-1/3 py-5 space-y-3" @submit="submit" enctype="multipart/form-data">
                        <div>
                            <InputLabel for="name" value="Nombre" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="phone" value="Telefono" />
                            <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"
                                autocomplete="phone" placeholder="+5704898655" />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <div>
                            <InputLabel for="avatar" value="Avatar" />
                            <FileInput name="avatar" @change="onSelectAvatar" />
                            <InputError class="mt-2" :message="form.errors.avatar" />
                        </div>
                        <div>
                            <InputLabel for="privacity" value="Privacity" />
                            <select v-model="form.privacity"
                                class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                name="privacity" id="privacity">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.privacity" />
                        </div>
                        <div class="flex justify-center">
                            <PrimaryButton>
                                Crear Contacto
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
