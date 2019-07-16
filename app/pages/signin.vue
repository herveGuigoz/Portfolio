<template>
    <div class="grid grid-pad">
        <div class="col-1-1 h-screen flex justify-center items-center">
            <div class="w-full max-w-sm">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <Input @content="setEmail"
                            value="Email"/>

                    <Input  @content="setFirstname"
                            value="Firstname"/>

                    <Input @content="setLastname"
                            value="Lastname"/>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input  v-model="userInput.password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                        <p v-if="error" class="text-red-500 text-xs italic">{{ error }}</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmpassword">
                            Confirm Password
                        </label>
                        <input  v-model="confirmPassword"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="confirmpassword" type="password" placeholder="******************">
                    </div>

                    <div class="flex items-center justify-between">
                        <button @click="postSignup"
                                class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Send
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-teal-500 hover:text-teal-800" href="#">
                            <nuxt-link to="/login">Already an account ? Login</nuxt-link>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Input from '@/components/UI/Input'
    const Cookie = process.client ? require('js-cookie') : undefined;

    export default {
        middleware: 'notAuthenticated',
        components: {
            Input
        },
        methods: {
            setEmail (e) {
                this.userInput.email = e
            },
            setFirstname (e) {
                this.userInput.firstname = e
            },
            setLastname (e) {
                this.userInput.lastname = e
            },
            async postSignup() {
                try {
                    const response = await fetch(
                        "http://127.0.0.1:8000/api/users",
                        {
                            method: "POST",
                            body: JSON.stringify(this.userInput),
                            headers: { "Content-type": "application/json; charset=UTF-8" }
                        }
                    );
                    this.$router.push('/')
                } catch (error) {
                    console.error(error);
                }
            }
        },
        data() {
            return {
                error: "",
                userInput: {
                    email: "",
                    password: "",
                    firstname: "",
                    lastname: ""
                },
                confirmPassword : ""
            }
        },
    }
</script>
