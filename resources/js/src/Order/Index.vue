<template>
    <div class="row">
        <h1 class="mt-3 ml-5">Заказы</h1>
    </div>
    <router-link :to="{ path: `order/create/`}" class="ml-5 btn btn-primary">Добавить</router-link>
    <div class="row ml-5">
        <div class="mb-3 w-25">
            <label for="warehouse">Выберите склад</label>
            <select v-model="warehouse_id" class="form-control"  id="warehouse" @click="getOrder">
                <option v-bind:value="null">Все</option>
                <option v-for="warehouse in warehouses" v-bind:value="warehouse.id" > {{warehouse.name}}</option>
            </select>
            <label for="status">Выберите статус</label>
            <select v-model="status" class="form-control"  id="status" @click="getOrder">
                <option v-bind:value="null">Все</option>
                <option value="active" > Активный</option>
                <option value="canceled" > Отменен</option>
                <option value="completed" > Завершен</option>
            </select>

            <label for="paginate">Выберите кол-во записей</label>
            <select v-model="paginate" class="form-control"  id="paginate" @click="getOrder">
                <option v-bind:value="null">Все</option>
                <option value="10" > 10</option>
                <option value="20" > 20</option>
                <option value="30" > 30</option>
            </select>
<!--            <label for="customer">Выберите клиента</label>-->
<!--            <input type="text" class="form-control" id="customer" v-model="customer" @click="getOrder">-->
        </div>
    </div>
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
                    <th :class="order.status === 'active'? '' : 'd-none'"><a href="#" @click.prevent="canceledOrder(order.id)" class="btn btn-danger">Отмена закза</a></th>
                    <th :class="order.status === 'canceled'? '' : 'd-none'"><a href="#" @click.prevent="activeOrder(order.id)" class="btn btn-warning">Возобновить заказ</a></th>
                    <th :class="order.status === 'completed'? '' : 'd-none'"><a href="#" class="btn btn-secondary" disabled>Заказ завершен</a></th>
                    <th :class="order.status === 'completed'? 'd-none' : ''"><a href="#" @click.prevent="completedOrder(order.id)" class="btn btn-success">Завершить заказ</a></th>
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
            warehouses: null,
            warehouse_id: null,
            created_at: null,
            completed_at: null,
            status: null,
            paginate:null,
            url: 'api/v1/order?',

        }
    },

    mounted() {
        this.getOrder();
        this.getWarehouse();
    },
    methods: {
        getWarehouse() {
            axios.get('/api/v1/warehouses')
                .then(res => {
                    this.warehouses = res.data.data;
                })
        },
        getOrder() {
            if(this.warehouse_id!==null){
                this.url = this.url + `warehouse_id=${this.warehouse_id}&`
            }
            if(this.status!==null){
                this.url = this.url + `status=${this.status}&`
            }
            if(this.paginate!==null){
                this.url = this.url + `paginate=${this.paginate}&`
            }

            axios.get(`${this.url}`)
                .then(res => {
                    this.orders = res.data.data;
                    console.log(this.url);
                    this.url = 'api/v1/order?';
                })
        },
        completedOrder(id){
            axios.get(`api/v1/order/${id}/completed`)
                .then(res => {
                    this.getOrder()
                })

        },
        canceledOrder(id){
            axios.get(`api/v1/order/${id}/canceled`)
                .then(res => {
                    this.getOrder()
                })

        },
        activeOrder(id){
            axios.get(`api/v1/order/${id}/active`)
                .then(res => {
                    this.getOrder()
                })
                .catch(function (error) {
                    alert('Недостаточно остатков');
                });

        }

    },
}


</script>

<script setup>

</script>

<style scoped>

</style>
