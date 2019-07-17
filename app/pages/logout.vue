<template>

</template>
<script>
    const Cookie = require('js-cookie')

    export default {
        middleware: 'authenticated',
        mounted() {
            Cookie.remove('auth')
            this.$store.commit('setAuth', null)
            this.$router.push('/login')
        }
    }
</script>