<template>
    <!-- Поля редактирования пользователя -->
    <td>{{ this.person.id }}</td>
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
        <!-- Кнопка подтверждения -->
        <button @click.prevent="$emit('update', person)" class="btn btn-white btn-sm shadow-sm">
            ✅
        </button>
    </td>
    <td>
        <!-- Кнопка отмены -->
        <button @click.prevent="$emit('cancel', person)" class="btn btn-white btn-sm shadow-sm">
            ✖️
        </button>
    </td>
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
    name: "EditTableComponent",
    // Объявляем, что компонент умеет испускать события
    emits: ['update', 'cancel'],
    // Получаем объект person через props
    props: {
        person: Object,
    },
};
</script>

