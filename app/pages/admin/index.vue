<template>
    <div>
        <!-- TODO if resume Edit your resume-->
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

        <div class="flex px-3">
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-2">Experiences :</p>
                <nuxt-link to="/admin/experience"><Button value="add"/></nuxt-link>
            </div>
            <div class="flex-1 px-6 uppercase text-gray-700">
                dssfsd
            </div>
        </div>
    </div>
</template>
<script>
    import Textarea from '@/components/UI/Textarea'
    import Button from '@/components/UI/Button'
    export default {
        layout: 'admin',
        components: {
            Textarea,
            Button
        }
    }
</script>
<style>

</style>