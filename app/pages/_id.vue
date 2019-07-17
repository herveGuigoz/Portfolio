<template>
    <div id="app">
        <Name v-bind:user="resume.user"/>
        <MainContent v-bind:resume="resume"/>
        <About
                @openModal="isOpen = true"
                :isOpen="this.isOpen"
        />
        <contact/>
        <transition
                name="fade"
                @after-enter="showContent = true"
        >
            <modal
                    v-if="isOpen"
                    @close="isOpen = false"
                    @hideContent="showContent = false"
                    :showContent="this.showContent"
                    v-bind:resume="resume"
                    v-bind:technos="technos"
                    v-bind:softskills="softskills"
            />
        </transition>
    </div>
</template>

<script>
    import axios from 'axios'
    import Name from '@/components/Name.vue'
    import MainContent from '@/components/MainContent.vue'
    import About from '@/components/About.vue'
    import Modal from '@/components/Modal'
    import Contact from "@/components/Contact";

    export default {
        components: {
            Contact,
            Name,
            MainContent,
            About,
            Modal,
        },
        async asyncData ({ params, error }) {
            try {
                const token = store.getters.getToken
                const config = {
                    headers: {'Authorization': "Bearer " + token}
                };
                const { data } = await axios.get("http://127.0.0.1:8000/api/resumes?user.id=" + params.id, config)
                return { resume: data['hydra:member'][0] }
            } catch (e) {
                console.log(e)
                //error({ message: 'Page not found', statusCode: 404 })
            }
        },
        data: function(){
            return {
                isOpen: false,
                showContent: false,
                technos: [],
                softskills: []
            }
        },
        computed: {
            toArray() {
                this.technos = this.resume.techno.split(',')
                this.softskills = this.resume.softSkills.split(',')
            }
        }
    }
</script>

<style>

    #app {
        padding: 0 2rem;
        height: 100vh;
        display: flex;
        flex-direction: row;
        flex-flow: nowrap;
    }

    a, abbr, acronym, address, applet, big, blockquote, body, button, caption, cite, code, dd, del, dfn, div, dl, dt, em, fieldset, font, form, h1, h2, h3, h4, h5, h6, html, iframe, img, ins, kbd, label, legend, li, object, ol, p, pre, q, s, samp, small, span, strike, strong, sub, sup, table, tbody, td, tfoot, th, thead, tr, tt, ul, var {
        font-family: Poppins,Helvetica,Arial,sans-serif;
        color: #2b2d30;
        font-family: 'Poppins', sans-serif;
        font-size: 1.4rem;
        line-height: 1.8;
        letter-spacing: .01em;
        font-weight: 400;
        font-style: normal;
        vertical-align: baseline;
        border: 0;
        outline: 0;
        padding: 0;
        margin: 0;
    }

    .main-content {
        font-size: 2.5rem;
    }

    .contact {
        width: 100%;
        background: #42b983;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
    .fade-enter-active, .fade-leave-active {
        transition: 0.2s opacity ease-out;
    }
</style>
