<template>
<div>
    <div>Color: {{ obj.color }} </div>
    <div>Number: {{ obj.number > 10 ? 'more 10' : 'less 10' }} </div>
    <div>Is published: {{obj.isPublished ? 'опубликован' : 'нет' }} </div>
</div>
</template>

<script>

export default {
    name: "SomeComponent",
    inject: ['parantLog'],
    data() {
        return {

        }
    },
    props:[
        'obj'
    ],
    mounted() {
        console.log(this.parantLog());
    },

    methods: {

    },
}
</script>

<style scoped>

</style>
