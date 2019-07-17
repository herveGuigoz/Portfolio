<template>
    <div>
        <div class="flex justify-end px-3">
            <button @click="logout">
                Logout
            </button>
        </div>
        <Experience v-if="experienceIsOpen"
                    @cancel="close"/>
        <!-- TODO if resume Edit your resume-->
        <div v-if="!experienceIsOpen">
            <p class="px-3">Create your resume</p>
            <div class="flex pt-3">
                <div class="w-1/2 p-3">
                    <Textarea id="accroche" label="Accroche"/>
                </div>

                <div class="w-1/2 p-3">
                    <Textarea id="situation" label="Situation"/>
                </div>
            </div>

            <div class="w-full p-3">
                <Textarea id="description" label="Description"/>
            </div>

            <div class="w-full p-3">
                <Input value="Soft Skills"/>
            </div>

            <div class="flex px-3">
                <div>
                    <p class="block text-gray-700 text-sm font-bold mb-2">Experiences :</p>
                    <button @click="experienceIsOpen = true"
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        +
                    </button>
                </div>
                <div class="flex-1 px-6 uppercase text-gray-700">
                    dssfsd
                </div>
            </div>

            <div class="w-full px-3 pt-6">
                <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    test
                </button>
                {{ user.id }}
            </div>
        </div>
    </div>
</template>
<script>
    const Cookie = process.client ? require('js-cookie') : undefined
    import axios from 'axios'
    import Experience from '@/components/admin/Experience'
    import Input from '@/components/UI/Input'
    import Textarea from '@/components/UI/Textarea'
    import Button from '@/components/UI/Button'
    export default {
        layout: 'admin',
        validate ({ params }) {
            return !isNaN(+params.id)
        },
        components: {
            Experience,
            Textarea,
            Button,
            Input
        },
        data() {
            return {
                experienceIsOpen : false,
                error: null,
                exp : {
                    titre : '',
                    description : '',
                    technos : '',
                    year: '',
                }
            }
        },
        async asyncData ({ store, params, error }) {
            try {
                const token = store.getters.getToken
                const config = {
                    headers: {'Authorization': "Bearer " + token}
                };
                const { data } = await axios.get("http://127.0.0.1:8000/api/users/" + params.id,
                config)
                // TODO/ Virer ce console.log
                console.log(data)
                return { user: data }
            } catch (e) {
                console.log(e)
                //error({ message: 'User not found', statusCode: 404 })
            }
        },
        methods: {
            close() {
                this.experienceIsOpen = false
            },
            logout () {
                Cookie.remove('auth')
                Cookie.remove('id')
                this.$store.commit('setAuth', null)
                this.$router.push('/login')
            },
            async postExp() {
                try {
                    const token = store.getters.getToken
                    const config = {
                        headers: {'Authorization': "Bearer " + token}
                    };

                } catch(e) {
                    console.log(e)
                }
            }
        }
    }
</script>
<style>

</style>