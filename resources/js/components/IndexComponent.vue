<template>
    <!-- Контейнер таблицы -->
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <!-- Таблица с пользователями -->
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
                    <!-- Перебираем всех пользователей -->
                    <tr v-for="person in persons" :key="person.id">
                        <!-- Если редактируется именно эта строка -->
                        <template v-if="editPersonId === person.id">
                            <!-- Показываем форму редактирования -->
                            <edit-table-component
                                :person="person"
                                @update="updatePerson"
                                @cancel="cancelEditPerson"
                            />
                        </template>
                        <template v-else>
                            <!-- Иначе — обычное отображение -->
                            <show-table-component
                                :person="person"
                                @edit="changeEditPersonId"
                                @delete="deletePerson"
                            />
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
import EditTableComponent from "@/components/EditTableComponent.vue";
import ShowTableComponent from "@/components/ShowTableComponent.vue";
export default {
    name: "IndexComponent",
    components: {ShowTableComponent, EditTableComponent},
    data() {
        return {
            // Массив всех людей из базы
            persons: [],
            // ID пользователя, которого сейчас редактируют
            editPersonId: null,
            // Оригинальные данные до редактирования (для отмены)
            defaultPerson: null,
        };
    },
    mounted() {
        // Загружаем людей при загрузке компонента
        this.getPeople();
    },
    methods: {
        getPeople() {
            // получили всех и положили в масив для фора
            axios.get("/api/people/persons").then((response) => {
                this.persons = response.data;
            });
        },
        // Обновить данные пользователя
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
                // можно вызвать и этот метод  getPeople(), зануление
                this.editPersonId = null;
            })
        },
        changeEditPersonId(id, person) {
            this.editPersonId = id;
            // console.log('айди строки/юзера' + ' ' + id, person);
            // Сохраняем оригинальные данные перед редактированием / передаем нашего типа для сохранения в дефолтыч
            this.defaultPerson = {...person}
        },
        cancelEditPerson(person) {
            //console.log(person);
            // Пользователь начал редактирование и внёс изменения.
            // Мы сохранили оригинальные данные в defaultPerson.
            // При нажатии на "Отменить" — возвращаем исходные значения.
            // Восстанавливаем данные из defaultPerson
            person.name = this.defaultPerson.name;
            person.age = this.defaultPerson.age;
            person.job = this.defaultPerson.job;

            // Выключаем режим редактирования и очищаем сохранённые данные
            this.editPersonId = null;
            this.defaultPerson = null;
        },
        // Удалить пользователя
        deletePerson(id) {
            //console.log(id);
            axios.delete(`/api/people/${id}`).then((response) => {
                const toast = useToast()
                // библиотека для красивой плюшки
                toast.error(response.data.status || 'Удалено успешно')
                this.getPeople(); // Обновляем список
            })
        },
        // Просто тестовый лог
        indexLog() {
            return console.log("this is index component");
        },
    },
};
</script>

<style scoped>
</style>
