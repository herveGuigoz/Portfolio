<template>
    <div class="grid grid-pad">
        <div class="col-1-1 h-screen flex justify-center items-center">
            <div class="w-full max-w-xs">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="Email">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                        <p v-if="error" class="text-red-500 text-xs italic">{{ error }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Sign In
                        </button>
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

    export default {
        middleware: 'notAuthenticated',
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
