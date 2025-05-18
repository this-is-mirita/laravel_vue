<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Job</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <!--
            | person.id | editPersonId | Условие `editPersonId === person.id` | Что покажет?         |
            | --------- | ------------ | ------------------------------------ | -------------------- |
            | 1         | 2            | ❌ `1 !== 2`                          | обычный вид          |
            | 2         | 2            | ✅ `2 === 2`                          | форма редактирования |
            | 3         | 2            | ❌ `3 !== 2`                          | обычный вид          |
            -->
            <tr v-for="person in persons" :key="person.id">
                <template v-if="editPersonId === person.id">
                    <td>{{ person.id }}</td>
                    <td><input class="form-control" type="text" v-model="person.name" /></td>
                    <td><input class="form-control" type="number" v-model="person.age" /></td>
                    <td><input class="form-control" type="text" v-model="person.job" /></td>
                    <td>
                        <button @click.prevent="updatePerson(person)" class="btn btn-success">Обновить</button>
                    </td>
                    <td>
                        <button @click.prevent="cancelEditPerson(person)" class="btn btn-success">Отменить</button>
                    </td>
                </template>
                <template v-else>
                    <td>{{ person.id }}</td>
                    <td>{{ person.name }}</td>
                    <td>{{ person.age }}</td>
                    <td>{{ person.job }}</td>
                    <td>
                        <button @click.prevent="changeEditPersonId(person.id, person)" class="btn btn-success">Редактировать</button>
                    </td>
                </template>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "IndexComponent",
    data() {
        return {
            persons: [],
            editPersonId: null,
            // для отмены чтоб данные были дефолтыч
            defaultPerson: null,
        };
    },
    mounted() {
        this.getPeople();
    },
    methods: {
        getPeople() {
            // получили всех и положили в масив для фора
            axios.get("/api/people/persons").then((response) => {
                this.persons = response.data;
            });
        },
        updatePerson(person) {
            // @click="updatePerson(person)" весь объект person в метод:
            console.log(person); // { id: 2, name: 'Bob', age: 30, job: 'Designer' }
            axios.patch(`/api/people/persons/${person.id}`, {
                name: person.name,
                age: person.age,
                job: person.job,
            })
                .then((response) => {
                    console.log(response.data);
                    this.editPersonId = null;
                })
                .catch((error) => {
                    console.log(error.response?.data || error);
                });
        },
        changeEditPersonId(id, person) {
            this.editPersonId = id;
            console.log('айди строки/юзера' + ' ' + id, person);
            // передаем нашего типа для сохранения в дефолтыч
            this.defaultPerson = {...person}
        },
        cancelEditPerson(person) {
            console.log(person);

            // Пользователь начал редактирование и внёс изменения.
            // Мы сохранили оригинальные данные в defaultPerson.
            // При нажатии на "Отменить" — возвращаем исходные значения.

            person.name = this.defaultPerson.name;
            person.age = this.defaultPerson.age;
            person.job = this.defaultPerson.job;

            // Выключаем режим редактирования и очищаем сохранённые данные
            this.editPersonId = null;
            this.defaultPerson = null;
        }
    }
};
</script>

<style scoped>
</style>
