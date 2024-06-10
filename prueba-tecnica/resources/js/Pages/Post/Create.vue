<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import FileInput from '@/Components/FileInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const initialValues = {
    title: "",
    keywords: "",
    body: null,
};

const submit=(e)=>{
    e.preventDefault();
    form.post(route('post.store'));
}

const form = useForm(initialValues);


</script>


<template>

    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Post</h2>
                <Link :href="route('post.create')">Post List</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="w-1/3 py-5 space-y-3" @submit="submit" enctype="multipart/form-data">
                        <div>
                            <InputLabel for="title" value="Titulo" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.title" required
                                autofocus autocomplete="title" placeholder="Titulo" />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                        <div>
                            <InputLabel for="keywords" value="Keywords" />
                            <TextInput id="keywords" type="text" class="mt-1 block w-full" v-model="form.keywords"
                                autocomplete="keywords" placeholder="Palabras clave" />
                            <InputError class="mt-2" :message="form.errors.keywords" />
                        </div>
                        <div>
                            <InputLabel for="body" value="Body" />
                            <TextInput id="body" type="text" class="mt-1 block w-full" v-model="form.body"
                                autocomplete="body" placeholder="Cuerpo del post" />
                            <InputError class="mt-2" :message="form.errors.body" />
                        </div>
                        
                        <div class="flex justify-center">
                            <PrimaryButton>
                                Crear Post
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
