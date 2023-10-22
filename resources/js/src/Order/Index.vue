<template>
    <div class="row">
        <h1 class="mt-3 ml-5">Заказы</h1>

    </div>
    <router-link :to="{ path: `order/create/`}" class="ml-5 btn btn-primary">Добавить</router-link>
    <div class="row ml-2">
        <table class="table mt-3">
            <thead>
            <tr>
                <th>№</th>
                <th>Клиент</th>
                <th>Склад</th>
                <th>Дата заказа</th>
                <th>Дата завершения</th>
                <th>Статус</th>
                <th>Подробнее</th>
                <th>Отмена закза</th>
                <th>Завершить заказ</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="order in orders">
                <tr>
                    <td>{{ order.id }}</td>
                    <td>{{ order.customer }}</td>
                    <td>{{ order.warehouse }}</td>
                    <td>{{ order.created_at }}</td>
                    <td>{{ order.completed_at }}</td>
                    <td>{{ order.status }}</td>
                    <td><router-link :to="{ path: `order/show/${order.id}`}" class="btn btn-primary">Подробнее</router-link></td>
                    <th><a href="#" @click.prevent="changeEditWarehouseId(warehouse.id, warehouse.name)" class="btn btn-warning">Отмена закза</a></th>
                    <th><a href="#" @click.prevent="changeEditWarehouseId(warehouse.id, warehouse.name)" class="btn btn-success">Завершить заказ</a></th>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "OrderIndex",

    data() {
        return {
            orders: null,
            editOrderId: null,
            customer: null,
            warehouse: null,
            created_at: null,
            completed_at: null,
            status: null,

        }
    },

    mounted() {
        this.getOrder()
    },
    methods: {
        getOrder() {
            axios.get('api/v1/order')
                .then(res => {
                    this.orders = res.data.data;
                })
        },

    },
}


</script>

<script setup>

</script>

<style scoped>

</style>
