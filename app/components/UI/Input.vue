<template>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" :for="value">
            {{ value }}
        </label>
        <input  @input="handleInput"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="value" type="text" :placeholder="value">
    </div>
</template>
<script>
    export default {
        name: 'Input',
        props: {
            value: {
                type: String,
                required: true
            }
        },
        methods: {
            handleInput (e) {
                this.$emit('content', e.target.value)
            }
        }
    }
</script>
