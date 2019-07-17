<template>
    <div>
        <p class="px-3">Create new experience</p>
        <div class="flex pt-3">
            <div class="w-1/2 p-3">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="titre">
                        Titre
                    </label>
                    <input  v-model="exp.titre"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="titre" type="text" placeholder="titre">
                </div>
            </div>
            <div class="w-1/5 p-3">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="year">
                        Year
                    </label>
                    <input  v-model.number="exp.year"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="year" type="number" placeholder="year">
                </div>
            </div>
        </div>
        <div class="w-full p-3">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="techo">
                    Technos
                </label>
                <textarea   v-model="exp.technos"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="techno"
                            rows="4">
                </textarea>
            </div>
        </div>

        <div class="w-full p-3">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea   v-model="exp.description"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="description"
                            rows="4">
        </textarea>
            </div>
        </div>

        <div class="flex px-3">
            <div>
                <button @click="cancel"
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Cancel
                </button>
            </div>
            <div class="px-3">
                <button @click="save"
                        class="bg-white hover:bg-gray-100 text-teal-500 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    import Input from '@/components/UI/Input'
    import Textarea from '@/components/UI/Textarea'
    import Button from '@/components/UI/Button'
    export default {
        layout: 'admin',
        components: {
            Input,
            Textarea,
            Button
        },
        props: ['res'],
        data() {
            return {
                exp : {
                    titre : '',
                    description : '',
                    technos : '',
                    year: null,
                }
            }
        },
        methods: {
            async save() {
                this.exp.resume = this.res['@id']
                const token = this.$store.getters.getToken
                try {
                    const config = {
                        headers: {'Authorization': "Bearer " + token}
                    };
                    await axios.post("http://127.0.0.1:8000/api/experiences", this.exp, config)
                    this.$emit('hide-xp', this.exp)
                } catch(e) {
                    console.log(e)
                }
            },
            cancel () {
                this.$emit()
            }
        },
    }
</script>
<style>

</style>