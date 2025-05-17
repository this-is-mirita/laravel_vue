<template>
<div class="row">
    PostComponent
    <single-post-component></single-post-component>
    <div class="col-4">
        <create-component></create-component>
    </div>
    <div class="col-8">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="person in persons" :key="person.id">
                <th scope="row">{{ person.id }}</th>
                <td>{{ person.name }}</td>
                <td>{{ person.age }}</td>
                <td>{{ person.job }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import SinglePostComponent from "@/components/SinglePostComponent.vue";
import CreateComponent from "@/components/CreateComponent.vue";
import data from "bootstrap/js/src/dom/data.js";
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
            axios.get("/persons")
            .then(res => {
                this.persons = res.data;
            })
            .catch(err => {
                console.log(err);
            }).finally(() => {

            })
        }
    },

    components : {
        CreateComponent,
        SinglePostComponent
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
