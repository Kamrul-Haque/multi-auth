<template>
    <Head title="Roles"/>
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
                {{ role.name }} - Assign Permissions </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 flex flex-col">
            <div class="md:w-1/3 sm:w-full bg-white border rounded-lg shadow m-auto p-5">
                <h4 class="text-2xl mb-4">Permissions</h4>
                <form id="permissionsForm"
                      @submit.prevent="submit">
                    <div v-for="(permission, index) in permissions"
                         :key="permission.id">
                        <label class="flex items-center">
                            <Checkbox id="role"
                                      :checked="assigned.some(current=>current.id===permission.id)"
                                      :value="permission.id"
                                      autofocus
                                      class="mt-1 block"
                                      name="permissions[]"
                                      type="checkbox"/>
                            <span class="ml-2">{{ permission.name }}</span>
                        </label>
                    </div>
                    <Button class="mt-4 float-right">Assign</Button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Authenticated';
import Button from "@/Components/Button";
import {Head} from '@inertiajs/inertia-vue3';
import Checkbox from "@/Components/Checkbox";
import {Inertia} from "@inertiajs/inertia";

export default {
    props: {
        role: Object,
        permissions: Array,
        assigned: Array
    },
    components: {
        Checkbox,
        Head,
        Layout,
        Button
    },
    methods: {
        submit() {
            var formData = new FormData(document.getElementById('permissionsForm'));
            Inertia.post(this.route('roles.assign.permissions', this.role), formData);
        }
    }
}
</script>