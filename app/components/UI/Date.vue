<template>
    <div>
        <label :for="id">Start date:</label>

        <input type="date" :id="id" :name="id"
               value="2018-07-22"
               min="2018-01-01" max="2018-12-31">
    </div>
</template>
<script>
export default {
    name: "Date",
    props: {
        label: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            now: new Date()
        }
    }
}
</script>
