<template>
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover align-middle text-center mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Возраст</th>
                        <th>Профессия</th>
                        <th colspan="2">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="person in persons" :key="person.id">
                        <template v-if="editPersonId === person.id">
                            <td>{{ person.id }}</td>
                            <td>
                                <input type="text" v-model="person.name" class="form-control form-control-sm shadow-sm" />
                            </td>
                            <td>
                                <input type="number" v-model="person.age" class="form-control form-control-sm shadow-sm" />
                            </td>
                            <td>
                                <input type="text" v-model="person.job" class="form-control form-control-sm shadow-sm" />
                            </td>
                            <td>
                                <button @click.prevent="updatePerson(person)" class="btn btn-white btn-sm shadow-sm">
                                    ✅
                                </button>
                            </td>
                            <td>
                                <button @click.prevent="cancelEditPerson(person)" class="btn btn-white btn-sm shadow-sm">
                                    ✖️
                                </button>
                            </td>
                        </template>
                        <template v-else>
                            <td>{{ person.id }}</td>
                            <td>{{ person.name }}</td>
                            <td>{{ person.age }}</td>
                            <td>{{ person.job }}</td>
                            <td>
                                <button @click.prevent="changeEditPersonId(person.id, person)" class="btn btn-white btn-sm shadow-sm">
                                    ✏️
                                </button>
                            </td>
                            <td>
                                <button @click.prevent="deletePerson(person.id, person)" class="btn btn-white btn-sm shadow-sm">
                                    🗑️
                                </button>
                            </td>
                        </template>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<!--
            | person.id | editPersonId | Условие `editPersonId === person.id` | Что покажет?         |
            | --------- | ------------ | ------------------------------------ | -------------------- |
            | 1         | 2            | ❌ `1 !== 2`                          | обычный вид          |
            | 2         | 2            | ✅ `2 === 2`                          | форма редактирования |
            | 3         | 2            | ❌ `3 !== 2`                          | обычный вид          |
            -->
<script>
import {useToast} from "vue-toastification";

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
           // console.log(person); // { id: 2, name: 'Bob', age: 30, job: 'Designer' }
            axios.patch(`/api/people/persons/${person.id}`, {
                name: person.name,
                age: person.age,
                job: person.job,
            }).then((response) => {
                const toast = useToast()
                //console.log(response.data);
                toast.success('Данные обновлены успешно')
                // можно вызвать и этот метод  getPeople()
                this.editPersonId = null;
            })
        },
        changeEditPersonId(id, person) {
            this.editPersonId = id;
           // console.log('айди строки/юзера' + ' ' + id, person);
            // передаем нашего типа для сохранения в дефолтыч
            this.defaultPerson = {...person}
        },
        cancelEditPerson(person) {
           // console.log(person);

            // Пользователь начал редактирование и внёс изменения.
            // Мы сохранили оригинальные данные в defaultPerson.
            // При нажатии на "Отменить" — возвращаем исходные значения.

            person.name = this.defaultPerson.name;
            person.age = this.defaultPerson.age;
            person.job = this.defaultPerson.job;

            // Выключаем режим редактирования и очищаем сохранённые данные
            this.editPersonId = null;
            this.defaultPerson = null;
        },
        deletePerson(id) {
            //console.log(id);
            axios.delete(`/api/people/${id}`).then((response) => {
                const toast = useToast()
                // библиотека для красивой плюшки
                toast.error(response.data.status || 'Удалено успешно')
                this.getPeople()
            })
        },
    },
};
</script>

<style scoped>
</style>
