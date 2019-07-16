<template>
    <div class="grid grid-pad">
        <div class="col-1-1 h-screen flex justify-center items-center">
            <div class="w-full max-w-xs">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <Input value="Email"/>
                    <Input value="Password"/>
                    <div class="flex items-center justify-between">
                        <Button value="Sign In"/>
                        <a class="inline-block align-baseline font-bold text-sm text-teal-500 hover:text-teal-800" href="#">
                            <nuxt-link to="/signin">Create an account</nuxt-link>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    const Cookie = process.client ? require('js-cookie') : undefined
    import Input from '@/components/UI/Input'
    import Button from '@/components/UI/Button'

    export default {
        middleware: 'notAuthenticated',
        components: {
            Input,
            Button
        },
        methods: {
            postLogin () {
                console.log('logged')
            }
        },
        data() {
            return {
                error: ""
            }
        }
    }
</script>
