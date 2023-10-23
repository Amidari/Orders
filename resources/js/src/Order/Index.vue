<template>
    <div class="row">
        <div class="col-12">
        <h1 class="mt-3 ml-5 text-center">Заказы</h1>
        </div>
    </div>
    <div class="col-12 ">
        <router-link :to="{ path: `order/create/`}" class="mt-3 btn btn-primary">Добавить заказ</router-link>
    </div>
<!--    Фильтры-->
    <div class="row ml-5 mt-4">
        <div class="col-4">
            <label for="warehouse">Выберите склад</label>
            <select v-model="warehouse_id" class="form-control"  id="warehouse">
                <option v-bind:value="null">Все</option>
                <option v-for="warehouse in warehouses" v-bind:value="warehouse.id" > {{warehouse.name}}</option>
            </select>
        </div>
        <div class="col-4">
            <label for="status">Выберите статус</label>
            <select v-model="status" class="form-control"  id="status">
                <option v-bind:value="null">Все</option>
                <option value="active" > Активный</option>
                <option value="canceled" > Отменен</option>
                <option value="completed" > Завершен</option>
            </select>
        </div>
        <div class="col-4">
            <label for="paginate">Выберите кол-во записей</label>
            <select v-model="paginate" class="form-control"  id="paginate">
                <option value="10" > 10</option>
                <option value="20" > 20</option>
                <option value="30" > 30</option>
            </select>
        </div>

        <div class="col-12 text-center">
            <a href="#" @click.prevent="getOrder(1)" class="btn btn-success mt-3">Применить</a>
        </div>
    </div>
<!--    Таблица-->
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
                    <td>{{ order.status_name }}</td>
                    <td><router-link :to="{ path: `order/show/${order.id}`}" class="btn btn-primary">Подробнее</router-link></td>
                    <th :class="order.status === 'active'? '' : 'd-none'"><a href="#" @click.prevent="canceledOrder(order.id)" class="btn btn-danger">Отменить</a></th>
                    <th :class="order.status === 'canceled'? '' : 'd-none'"><a href="#" @click.prevent="activeOrder(order.id)" class="btn btn-warning">Возобновить</a></th>
                    <th :class="order.status === 'completed'? '' : 'd-none'"><a href="#" class="btn btn-secondary" disabled>Завершен</a></th>
                    <th :class="order.status === 'completed'? 'd-none' : ''"><a href="#" @click.prevent="completedOrder(order.id)" class="btn btn-success">Завершить</a></th>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
<!--    Пагинация-->
    <div class="row">
        <div class="col-12 d-flex justify-content-center wow fadeInUp animated">
            <ul class="pagination">
                <li v-if="pagination.current_page !==1" class="page-item">
                    <a @click.prevent="getOrder(pagination.current_page-1)" class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li v-for="link in pagination.links" class="page-item">
                    <template v-if="Number(link.label) &&
                        (pagination.current_page - link.label < 2 &&
                        pagination.current_page - link.label > -2) ||
                        Number(link.label)===1 || Number(link.label)===pagination.last_page
                        ">
                        <a @click.prevent="getOrder(link.label)" :class="link.active? 'active': ''" class="page-link"
                           href="#">{{ link.label }}</a>
                    </template>
                    <template v-if="Number(link.label) &&
                        pagination.current_page!==3 &&
                        (pagination.current_page - link.label === 2) ||
                        Number(link.label) &&
                        pagination.current_page!==pagination.last_page - 2 &&
                        (pagination.current_page - link.label === -2)">
                        <a>...</a>
                    </template>
                </li>
                <li v-if="pagination.current_page !== pagination.last_page" class="page-item">
                    <a @click.prevent="getOrder(pagination.current_page+1)" class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
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
            status: null,
            paginate: 10,
            pagination:[],

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
        getOrder(page=1) {
            axios.post('/api/v1/order', {
                'warehouse_id': this.warehouse_id,
                'status':this.status,
                'paginate':this.paginate,
                'page':page,

            })
                .then(res => {
                    this.orders = res.data.data;
                    this.pagination = res.data.meta
                    console.log(res);
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
