<template>
    <Head title="Users"/>
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
                {{ user.name }} - Assign Roles </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 flex flex-col">
            <div class="md:w-1/3 sm:w-full bg-white border rounded-lg shadow m-auto p-5">
                <h4 class="text-2xl mb-4">Roles</h4>
                <form id="rolesForm"
                      @submit.prevent="submit">
                    <div v-for="(role, index) in roles"
                         :key="role.id">
                        <label class="flex items-center">
                            <Checkbox id="user"
                                      :checked="assigned.some(current=>current.id===role.id)"
                                      :value="role.id"
                                      autofocus
                                      class="mt-1 block"
                                      name="roles[]"
                                      type="checkbox"/>
                            <span class="ml-2">{{ role.name }}</span>
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
        user: Object,
        roles: Array,
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
            var formData = new FormData(document.getElementById('rolesForm'));
            Inertia.post(this.route('users.assign.roles', this.user), formData);
        }
    }
}
</script>