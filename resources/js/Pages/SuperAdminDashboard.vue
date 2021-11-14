<template>
    <Head title="Super-Admin Dashboard" />

    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Super-Admin Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in as Super Admin!
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Authenticated';

export default {
    components: {
        Head,
        Layout,
    },
}
</script>
