<script setup>

</script>

<template>
    <div class="row">
        <h1 class="mt-3 ml-5">Движение товаров</h1>
    </div>


    <div class="row ml-5">
        <div class="mb-3 w-25">
            <label for="customer">Выберите склад</label>
            <select v-model="warehouse_id" class="form-control" @click="getMovement">
                <option v-bind:value="null">Все</option>
                <option v-for="warehouse in warehouses" v-bind:value="warehouse.id" > {{warehouse.name}}</option>
            </select>
            <label for="customer">Выберите статус</label>
            <select v-model="status" class="form-control" @click="getMovement">
                <option v-bind:value="null">Все</option>
                <option value="Списание" > Списание</option>
                <option value="Поступление" > Поступление</option>
            </select>
            <label for="customer">Выберите продукт</label>
            <select v-model="product_id" class="form-control" @click="getMovement">
                <option v-bind:value="null">Все</option>
                <option v-for="product in allProducts" v-bind:value="product.id" > {{product.name}}</option>

            </select>
            <label for="paginate">Выберите кол-во записей</label>
            <select v-model="paginate" class="form-control"  id="paginate" @click="getMovement">
                <option v-bind:value="null">Все</option>
                <option value="10" > 10</option>
                <option value="20" > 20</option>
                <option value="30" > 30</option>
            </select>
        </div>
    </div>
    <div class="row ml-2">
        <table class="table mt-3">
            <thead>
            <tr>
                <th>№</th>
                <th>Статут</th>
                <th>Количество</th>
                <th>Продукт</th>
                <th>Склад</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="movement in movements">
                <tr>
                    <td>{{ movement.id }}</td>
                    <td>{{ movement.status }}</td>
                    <td>{{ movement.move }}</td>
                    <td>{{ movement.products }}</td>
                    <td>{{ movement.warehouses }}</td>
                    <td>{{ movement.created_at }}</td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
    <br>
    <br>
</template>

<script>
import axios from "axios";

export default {
    name: "MovementIndex",

    data() {
        return {
            movements: null,
            status: null,
            allProducts:null,
            product_id: null,
            warehouses: null,
            warehouse_id: null,
            paginate: null,
            url: 'api/v1/movements?',

        }
    },
    mounted() {
        this.getMovement();
        this.getWarehouse();
        this.getAllProduct();
    },
    methods: {
        getMovement() {
            if(this.warehouse_id!==null){
                this.url = this.url + `warehouse_id=${this.warehouse_id}&`
            }
            if(this.status!==null){
                this.url = this.url + `status=${this.status}&`
            }
            if(this.product_id!==null){
                this.url = this.url + `product_id=${this.product_id}&`
            }
            if(this.paginate!==null){
                this.url = this.url + `paginate=${this.paginate}&`
            }
            axios.get(`${this.url}`)
                .then(res => {
                    this.movements = res.data.data;
                    this.url = 'api/v1/movements?';
                })
        },
        getWarehouse() {
            axios.get('/api/v1/warehouses')
                .then(res => {
                    this.warehouses = res.data.data;
                })
        },
        getAllProduct(){
            axios.get(`/api/v1/product`)
                .then(res => {
                    this.allProducts = res.data.data
                })
        },
    }
}
</script>

<style scoped>

</style>
