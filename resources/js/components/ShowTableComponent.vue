<template>
    <!-- Строка пользователя в таблице -->
    <td>{{ person.id }}</td>
    <td>{{ person.name }}</td>
    <td>{{ person.age }}</td>
    <td>{{ person.job }}</td>
    <td>
        <!-- Кнопка редактирования -->
        <button @click.prevent="$emit('edit', person.id, person)" class="btn btn-white btn-sm shadow-sm">
            ✏️
        </button>
    </td>
    <td>
        <!-- Кнопка удаления -->
        <button @click.prevent="$emit('delete', person.id)" class="btn btn-white btn-sm shadow-sm">
            🗑️
        </button>
    </td>
</template>

<script>
export default {
    name: "ShowTableComponent",
    // Объявляем, что компонент умеет испускать события
    emits: ["edit", "delete"],
    // Получаем объект person через props
    props: {
        person: Object,
    },
};
</script>

<style scoped>
</style>
