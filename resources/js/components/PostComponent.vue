<template>
<div class="row">
    <div class="col-4">
        <create-component @person-added="refreshList"></create-component>
    </div>
    <div class="col-8">
        <index-component ref="indexRef"></index-component>
    </div>
</div>
</template>

<script>
import CreateComponent from "@/components/CreateComponent.vue";
import IndexComponent from "@/components/IndexComponent.vue";
export default {
    name: "PostComponent",

    data() {
        return {
            persons: null,
        }
    },
    mounted() {
        this.getPersons()
    },
    methods: {
        getPersons(){
            axios.get("/")
            .then(res => {
                this.persons = res.data;
            })
            .catch(err => {
               console.log(err);
            })
        },
        refreshList() {
            this.$refs.indexRef.getPeople(); // вызов метода из дочернего компонента
        },
    },

    components : {
        IndexComponent,
        CreateComponent,
    }
}
</script>

<style scoped>

</style>

<!--export default {-->
<!--name: "PostComponent",-->

<!--data() {-->
<!--return {-->
<!--name: "Вася",-->
<!--age: 20,-->

<!--}-->
<!--},-->

<!--methods: {-->
<!--sayHello() {-->
<!--console.log('sayHello');-->
<!--},-->
<!--sayHai(){-->
<!--console.log('sayHai');-->
<!--},-->

<!--},-->

<!--computed:{-->
<!--vasyaJob(){-->
<!--return this.name + ' work vue'-->
<!--}-->
<!--},-->

<!--components : {-->
<!--SinglePostComponent-->
<!--}-->
<!--}-->
