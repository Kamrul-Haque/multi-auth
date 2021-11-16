<template>
    <div class="max-w-7xl m-auto px-4 sm:px-6 lg:px-8 my-6">
        <div v-if="$page.props.flash.success && show"
             class="flex justify-between bg-green-500 rounded">
            <div class="py-4 pl-4 w-full text-white text-sm font-medium">{{ $page.props.flash.success }}</div>
            <button class="group mr-2 p-2 text-white"
                    type="button"
                    @click="show = false">
                &times;
            </button>
        </div>
        <div v-if="$page.props.flash.error && show"
             class="flex justify-between bg-red-400 rounded">
            <div class="py-4 pl-4 text-white text-sm font-medium">{{ $page.props.flash.error }}</div>
            <button class="group mr-2 p-2 text-white"
                    type="button"
                    @click="show = false">
                &times;
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true
            },
            deep: true,
        },
    },
}
</script>
