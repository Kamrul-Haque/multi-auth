<template>
    <input
            ref="input"
            :value="modelValue"
            class="border border-gray-300 focus:border-gray-300 focus:ring-0 focus:border-gray-500 rounded-md shadow-sm"
            @input="$emit('update:modelValue', $event.target.value)">
</template>

<script>
export default {
    props: ['modelValue'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
