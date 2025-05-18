<template>
<div class="row">
    <div class="col-4">
        <create-component ref="createRef" @person-added="refreshList"></create-component>
    </div>
    <div class="col-8">
        <index-component ref="indexRef" ></index-component>
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
        this.getPersons();
        // на компонент вещаем ref="indexRef" и чяерез него можно вытянуть всё из дрогого компонента
        // console.dir(this.$refs.indexRef.testRefs);
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
        parantLog(){
            return console.log('this is post component');
        },
    },
    provide(){
        return {
            parantLog: this.parantLog,
        };
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
