<template>
    <div class="mb-3">
        <input type="text" class="form-control" v-model="name" placeholder="name">
    </div>
    <div class="mb-3">
        <input type="number" class="form-control" v-model="age" placeholder="age">
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" v-model="job" placeholder="job">
    </div>
    <div class="mb-3">
        <input @click.prevent="addPerson" class="btn btn-success" id="" value="Добавить">
    </div>
    <some-component :obj="obj"></some-component>
</template>

<script>
import someComponent from "@/components/SomeComponent.vue";
export default {
    name: "CreateComponent",
    emits: ['person-added'], // 💥 вот это добавь
    data() {
        return {
            name: null,
            age: null,
            job: null,

            obj: {
                color: 'yellow',
                number: 11,
                isPublished: false,
            }
        }
    },
    mounted() {
        console.log(this.$parent.$refs.indexRef.indexLog());
    },

    methods: {
        addPerson() {
            //console.log(this.name, this.age, this.job);
            axios.post('/api/people', {
                name: this.name,
                age: this.age,
                job: this.job
            }).then(response => {
                this.name = null,
                this.age = null,
                this.job = null,

                this.$emit('person-added');
                console.log("Успешно:", response.data);
            }).catch(error => {
                console.error("Ошибка:", error.response.data);
            });
        },
    },
    components: {
        someComponent,
    }
}
</script>

<style scoped>

</style>
