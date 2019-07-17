<template>

</template>
<script>
    const Cookie = process.client ? require('js-cookie') : undefined

    export default {
        middleware: 'authenticated',
        mounted() {
            Cookie.remove('auth')
            this.$store.commit('setAuth', null)
            this.$router.push('/login')
        }
    }
</script>