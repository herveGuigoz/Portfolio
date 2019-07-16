<template>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" :for="id">
            {{ label }}
        </label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  :id="id"
                  rows="4">
        </textarea>
    </div>
</template>
<script>
    export default {
        name: 'Textarea',
        props: {
            id: {
                type: String,
                required: true
            },
            label: {
                type: String,
                required: true
            }
        }
    }
</script>
