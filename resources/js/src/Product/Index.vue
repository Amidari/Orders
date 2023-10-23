<script setup>

</script>

<template>
    <div class="row">
            <h1 class="col mt-3 text-center">Товары</h1>
    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Продукт</th>
            <th scope="col">Цена</th>
            <th scope="col">Остатки</th>
            <th scope="col">Именить</th>
<!--            <th scope="col">Удалить</th>-->
        </tr>
        </thead>
        <tbody>
        <template v-for="product in products">
            <tr :class="isEdit(product.id)? 'd-none' : ''">
                <th>{{ product.id }}</th>
                <td>{{ product.name }}</td>
                <td>{{ product.price}}</td>
                <td><a href="#" @click.prevent="stockProduct(product.id)" class="btn btn-secondary">Остатки</a></td>
                <td><a href="#" @click.prevent="changeEditProductId(product.id, product.name, product.price)" class="btn btn-success">Именить</a></td>
<!--                <td><a href="#" @click.prevent="deleteProduct(product.id)" class="btn btn-danger">Удалить</a></td>-->
            </tr>
            <tr :class="isEdit(product.id)? '' : 'd-none'">
                <th>{{ product.id }}</th>
                <td><input type="text" class="form-control" v-model="name"></td>
                <td><input type="text" class="form-control" v-model="price"></td>
                <td><a href="#" @click.prevent="updateProduct(product.id)" class="btn btn-success">Сохранить</a></td>
            </tr>
            <tr :class="isStock(product.id)? '' : 'd-none'" class="table-secondary">
                <th></th>
                <th >Склад</th>
                <th>Остаток</th>
                <th colspan="2"><a href="#" @click.prevent="stockProduct(null)" class="btn btn-info">Свернуть</a></th>

            </tr>
            <template v-for="stock in stocks">
            <tr :class="isStock(product.id)? '' : 'd-none'" v-if="product.id === stock.product_id" class="table-secondary">
                <th></th>
                <td>{{ stock.warehouse }}</td>
                <td colspan="3">{{ stock.stock }}</td>
            </tr>
            </template>
        </template>
        </tbody>
    </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ProductIndex",

    data() {
        return {
            products: null,
            editProductId: null,
            name: null,
            price: null,
            stocks: null,
            stockId: null,

        }
    },

    mounted() {
        this.getProduct()
        this.getStock()
    },
    methods: {
        getProduct() {
            axios.get('api/v1/product')
                .then(res => {
                    this.products = res.data.data;
                })
        },
        getStock(){
          axios.get('api/v1/stocks')
              .then(res=>{
                  this.stocks = res.data.data
              })
        },
        updateProduct(id){
            this.editProductId = null;
            axios.post(`api/v1/product/${id}/update`, {name: this.name, price: this.price})
                .then(res => {
                    this.getProduct()
                })

        },
        deleteProduct(id){
            this.editProductId = null;
            axios.post(`api/v1/product/${id}/delete`)
                .then(res => {
                    this.getProduct()
                    this.addName = null;
                })

        },

        stockProduct(id){
            this.stockId = id
        },
        isStock(id){
            return this.stockId === id

        },
        changeEditProductId(id, name, price) {
            this.editProductId = id
            this.name = name
            this.price = price

        },

        isEdit(id) {
            return this.editProductId === id
        }
    },
}
</script>


<style scoped>

</style>
