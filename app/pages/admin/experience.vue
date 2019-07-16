<template>
    <div>
        <p class="px-3">Create new experience</p>
        <div class="flex pt-3">
            <div class="w-1/2 p-3">
                <Input value="title"/>
            </div>
            <div class="w-1/5 p-3">
                <Input value="Year"/>
            </div>
        </div>
        <div class="w-full p-3">
            <Textarea id="techno" label="Technos (separated by commas)"/>
        </div>

        <div class="w-full p-3">
            <Textarea id="description" label="Description"/>
        </div>

        <div class="flex px-3">
            <div>
                <nuxt-link to="/admin"><Button value="Cancel"/></nuxt-link>
            </div>
            <div class="px-3">
                <Button @click="save" value="Add"/>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment'
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
        methods: {
            save() {
                console.log(moment('12-25-1995', 'MM-DD-YYYY').format('MMMM'))
            }
        }
    }
</script>
<style>

</style>