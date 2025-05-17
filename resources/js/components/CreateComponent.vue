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
</template>

<script>

export default {
    name: "CreateComponent",

    data() {
        return {
            name: null,
            age: null,
            job: null,
        }
    },

    methods: {
        addPerson() {
            //console.log(this.name, this.age, this.job);

            axios.post('/api/people', {
                name: this.name,
                age: this.age, // убедись, что это число
                job: this.job
            }).then(response => {
                this.name = null,
                this.age = null,
                this.job = null,
                console.log("Успешно:", response.data);
            }).catch(error => {
                console.error("Ошибка:", error.response.data);
            });

        }
    },
}
</script>

<style scoped>

</style>
