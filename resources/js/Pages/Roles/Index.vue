<template>
    <Head title="Roles"/>
    <Layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
                <input id="search"
                       v-model="search"
                       autofocus
                       class="h-7 text-sm border border-gray-200 focus:border-gray-400 focus:ring-0 rounded"
                       placeholder="search..."
                       type="text"/>
            </div>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold font-medium text-gray-500 uppercase"
                                    scope="col">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left font-bold font-medium text-gray-500 uppercase"
                                    scope="col">
                                    Permissions
                                </th>
                                <th class="px-6 py-3 text-right font-bold font-medium text-gray-500 uppercase"
                                    scope="col">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="role in roles.data"
                                v-if="roles.data.length"
                                :key="role.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ role.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span v-for="(permission, index) in role.permissions"
                                          :key="permission.id">{{ permission.name
                                                               }}<span v-if="index !== role.permissions.length - 1">,
                                                                </span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="this.route('roles.assign.permissions.form', role)"
                                          class="text-green-500 hover:underline mr-2">Assign
                                    </Link>
                                    <Link :href="this.route('roles.edit', role)"
                                          class="text-blue-400 hover:underline mr-2">Edit
                                    </Link>
                                    <Link :href="this.route('roles.destroy', role)"
                                          as="button"
                                          class="text-red-700 hover:underline ml-2"
                                          method="delete">Delete
                                    </Link>
                                </td>
                            </tr>
                            <tr v-else>
                                <td class="px-6 py-4 whitespace-nowrap text-center"
                                    colspan="3">
                                    No Data Found.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between mt-6">
                        <Paginator :links="roles.links"></Paginator>
                        <Link :href="this.route('roles.create')"
                              class="float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                            Create
                        </Link>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Authenticated';
import Button from "@/Components/Button";
import {Inertia} from "@inertiajs/inertia";
import Paginator from "@/Components/Paginator";
import {Link} from "@inertiajs/inertia-vue3";
import {debounce} from "lodash";

export default {
    props: {
        roles: Object,
        filter: String,
    },
    components: {
        Head,
        Layout,
        Button,
        Link,
        Paginator,
    },
    data() {
        return {
            search: this.filter ?? '',
        }
    },
    watch: {
        search: debounce(function () {
            this.getRoles();
        }, 300)
    },
    methods: {
        getRoles() {
            Inertia.get(this.route('roles.index'), {search: this.search}, {
                preserveState: true
            });
        }
    }
}
</script>
