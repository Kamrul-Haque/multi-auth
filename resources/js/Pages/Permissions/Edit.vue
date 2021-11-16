<template>
    <Head title="Permissions"/>
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Permission
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 flex flex-col">
            <div class="md:w-1/3 sm:w-full bg-white border rounded-lg shadow m-auto p-5">
                <form @submit.prevent="submit">
                    <div>
                        <Label for="role"
                               value="Permission"/>
                        <Input id="role"
                               v-model="form.name"
                               autofocus
                               class="mt-1 block w-full"
                               required
                               type="text"/>
                        <span v-if="form.errors.name"
                              class="text-sm text-red-700"
                              v-html="form.errors.name"></span>
                        <Button class="mt-4 float-right">Update</Button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Authenticated';
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
import {Head} from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        Layout,
        Button,
        Label,
        Input,
    },
    props: {
        permission: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.permission.name ?? '',
            })
        }
    },
    methods: {
        submit() {
            this.form.put(this.route('permissions.update', this.permission));
        }
    }
}
</script>

<style scoped>

</style>