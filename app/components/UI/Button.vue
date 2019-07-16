<template>
    <div>
        <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            {{ value }}
        </button>
    </div>
</template>
<script>
    export default {
        name: 'Button',
        props: {
            value: {
                required: true,
                type: String
            }
        }
    }
</script>