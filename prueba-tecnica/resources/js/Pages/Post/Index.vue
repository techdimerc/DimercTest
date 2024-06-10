<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const posts = ref(page.props.posts);

const onDeleteSuccess = (e) => {
    posts.value = e.props.posts;
}

</script>

<template>

    <Head title="Post" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Post</h2>
                <Link :href="route('post.create')">Crear Post</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div className="relative overflow-x-auto">
                        <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" className="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Keywords
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Body
                                    </th>   
                                    <th scope="col" className="px-6 py-3">
                                        Acciones
                                    </th>                                 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts"
                                    className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ post.title }}
                                    </th>
                                    <td className="px-6 py-4">
                                        {{ post.keywords }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ post.body }}
                                    </td>      
                                    <td className="px-6 py-4">
                                        <div class="space-x-2">
                                            <Link :href="route('post.edit', post)">
                                            Edit
                                            </Link>
                                            <Link @success="onDeleteSuccess" :href="route('post.destroy', post)"
                                                method="delete" as="button">
                                            Eliminar
                                            </Link>
                                        </div>
                                    </td>                                                            
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
