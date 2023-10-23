<script setup>

</script>

<template>
    <div v-if="orders != null" >
    <div class="row ml-3">
        <h1 class="mt-3 ml-2">Карточка заказа</h1>
    </div>
        <div class="w-25 ml-5">
            <div class="mb-3">
                <label for="index">Номер заказа</label>
                <input type="text" class="form-control" id="index" v-model="orders.id" disabled>
            </div>
            <div class="mb-3">
                <label for="customer">Клиент</label>
                <input type="text" class="form-control" id="customer" v-model="orders.customer">
                <a href="#" @click.prevent="refreshOrder(orders.customer)" class="btn btn-success mt-2">Изенить</a>
            </div>
            <div class="mb-3">
                <label for="created_at">Дата заказа</label>
                <input type="text" class="form-control" id="created_at" v-model="orders.created_at" disabled>
            </div>
            <div class="mb-3">
                <label for="completed_at">Дата завершения</label>
                <input type="text" class="form-control" id="completed_at" v-model="orders.completed_at" disabled>
            </div>
            <div class="mb-3">
                <label for="status">Статус</label>
                <input type="text" class="form-control" id="status" v-model="orders.status" disabled>
            </div>
        </div>
    <div class="row ml-2">
        <label>Список продуктов</label>
        <table class="table">
            <thead>
            <tr>
                <th>Продукт</th>
                <th>Количество</th>
                <th>Остаток на складе</th>
                <th>Удалить</th>

            </tr>
            </thead>
            <tbody>
            <template v-for="product in orders.products ">

                <tr>
                    <td>{{ product.name }}</td>
                    <td>{{ product.count }}</td>
                    <template v-for="value in orders.stocks" >
                    <td v-if="product.id === value.product_id">{{value.stock}}</td>
                    </template>
                    <td><a href="#" @click.prevent="deleteProduct(product.id, product.count)" class="btn btn-danger" :class="orders.status !== 'completed'? '' : 'd-none'">Удалить</a></td>
                </tr>

            </template>
            </tbody>
        </table>
    </div>
    <div class="row ml-2 mt-4" :class="orders.status !== 'active'? 'd-none' : ''">
        <label>Добавить продукт</label>
        <table class="table">
            <thead>
            <tr>
                <th>Продукт</th>
                <th>Количество</th>
                <th>Остаток на складе</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <tr >
                <td><select v-model="addProduct" class="form-control">
                    <option disabled value="">Выберите один из вариантов</option>
                    <option v-for="product in allProducts" v-bind:value="product.id" > {{product.name}}</option>
                </select></td>
                <td><input type="text" class="form-control" id="addProductCount" v-model="addProductCount" @click.prevent="getParamsForeProduct"></td>
                <td><input type="text" class="form-control" id="addProductStock" v-model="addProductStock" disabled></td>
                <td><a href="#" @click.prevent="addProductInOrder(addProduct)" class="btn btn-success">Добавить продукт</a></td>

            </tr>
            </tbody>
        </table>

    </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "OrderShow",

    data() {
        return {
            OrderId: this.$route.params.Id,
            orders: null,
            stocks: null,
            allProducts: null,
            getProduct: [],
            addProduct: null,
            addProductCount: null,
            addProductStock: null,

        }
    },
    mounted() {
        this.getOrder();
        this.getAllProduct();

    },
    methods: {
        getOrder() {
            axios.get(`/api/v1/order/${this.$route.params.Id}/show`)
                .then(res => {
                    this.orders = res.data
                    this.stocks = res.data.stocks
                })
        },
        addProductInOrder(){
            axios.post(`/api/v1/order/addProduct`, {order_id: this.orders.id, product_id:this.addProduct , count:this.addProductCount, warehouse_id:this.orders.warehouse_id})
                .then(res => {
                    this.getOrder()
                })
        },

        deleteProduct(id, count){
            axios.post(`/api/v1/order/deleteProduct`, {order_id: this.orders.id, product_id:id , count:count, warehouse_id:this.orders.warehouse_id})
                .then(res => {
                    this.getOrder()
                })

        },
        getAllProduct(){
            axios.get(`/api/v1/product`)
                .then(res => {
                    this.allProducts = res.data.data
                })
        },
        getParamsForeProduct(){

            this.stocks.forEach((stocks) => {
                if (stocks.product_id === this.addProduct){
                    this.addProductStock = stocks.stock
                }
            })

        },
        refreshOrder(name){
            axios.post(`/api/v1/order/refresh`, {order_id: this.orders.id, name:name})
                .then(res => {
                    this.getOrder()
                })

        }
    },
}
</script>

<style scoped>

</style>
