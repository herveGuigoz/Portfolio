<template>
    <div class="grid grid-pad">
        <div class="col-1-1 h-screen flex justify-center items-center">
            <div class="w-full max-w-xs">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <Input  @content="setEmail"
                            value="Email"/>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input  v-model="userInput.password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                        <p v-if="error" class="text-red-500 text-xs italic">{{ error }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <Button @click="postLogin" value="Sign In"/>
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
    import moment from 'moment'
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
            setEmail (e) {
                this.userInput.username = e
            },
            async postLogin() {
                try {
                    const response = await fetch(
                        "http://127.0.0.1:8000/api/login_check",
                        {
                            method: "POST",
                            body: JSON.stringify(this.userInput),
                            headers: { "Content-type": "application/json; charset=UTF-8" }
                        }
                    );
                    const data = await response.json();
                    const playload = JSON.parse(atob(data.token.split('.')[1]));
                    const auth = {
                        token : data.token,
                        id :playload.id
                    };
                    this.$store.commit('setAuth', auth)
                    Cookie.set('auth', data.token)
                    Cookie.set('id', playload.id)
                    this.$router.push('/admin/' + playload.id)
                } catch (error) {
                    console.error(error);
                }
            },
        },
        data() {
            return {
                error: "",
                userInput: {
                    username: '',
                    password: ""
                }
            }
        }
    }
</script>
