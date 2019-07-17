<template>
    <div>
        <div class="flex justify-end px-3">
            <button @click="logout">
                Logout
            </button>
        </div>
        <Experience v-bind:res="resume"
                    v-if="experienceIsOpen"
                    @hide-xp="close"/>
        <div v-if="!experienceIsOpen">
            <p class="px-3">Create your resume</p>
            <div class="flex pt-3">
                <div class="w-1/2 p-3">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="accroche">
                            Accroche
                        </label>
                        <textarea v-model="resume.accroche"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="accroche"
                                rows="4">
                        </textarea>
                    </div>
                </div>

                <div class="w-1/2 p-3">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="situation">
                            Situation
                        </label>
                        <textarea v-model="resume.situation"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  id="situation"
                                  rows="4">
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="w-full p-3">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea v-model="resume.description"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              id="description"
                              rows="4">
                    </textarea>
                </div>
            </div>

            <div class="w-full p-3">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="softskills">
                        Soft Skills (separated by commas)
                    </label>
                    <textarea v-model="resume.softSkills"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              id="softskills"
                              rows="4">
                    </textarea>
                </div>
            </div>

            <div class="w-full p-3">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="technos">
                        Technos (separated by commas)
                    </label>
                    <textarea v-model="resume.techno"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              id="technos"
                              rows="4">
                    </textarea>
                </div>
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
                    <div v-for="(exp, index) in resume.experiences" :key="index">
                        {{ exp.titre }} - {{ exp.year}}
                    </div>
                    <div v-for="(xp, index) in newXp" :key="index">
                        {{ xp.titre }} - {{ xp.year}}
                    </div>
                </div>
            </div>

            <div class="w-full px-3 pt-6">
                <button @click="put"
                        class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Save
                </button>
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
                newXp : []
            }
        },
        async asyncData ({ store, params, error }) {
            try {
                const token = store.getters.getToken
                const config = {
                    headers: {'Authorization': "Bearer " + token}
                };
                const { data } = await axios.get("http://127.0.0.1:8000/api/resumes?user.id=" + params.id,
                config)
                return { resume: data['hydra:member'][0] }
            } catch (e) {
                error({ message: 'Page not found', statusCode: 404 })
            }
        },
        methods: {
            close(xp) {
                this.newXp.push(xp)
                this.experienceIsOpen = false
            },
            logout () {
                Cookie.remove('auth')
                Cookie.remove('id')
                this.$store.commit('setAuth', null)
                this.$router.push('/')
            },
            async put() {
                const data= {
                    description: this.resume.description,
                    situation: this.resume.situation,
                    accroche: this.resume.accroche,
                    softSkills: this.resume.softSkills,
                    techno: this.resume.techno
                }
                const iri = this.resume['@id']
                const token = this.$store.getters.getToken
                try {
                    const config = {
                        headers: {'Authorization': "Bearer " + token}
                    };
                    await axios.put("http://localhost:8000/api/resumes/" + iri.slice(-1), data, config)
                    const alias = this.resume.user.firstname.toLowerCase() + '-' +this.resume.user.lastname.toLowerCase()
                    this.$router.push('/' + alias)
                } catch(e) {
                    console.log(e)
                }
            },
        }
    }
</script>
<style>

</style>