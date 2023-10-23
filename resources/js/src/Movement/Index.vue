<script setup>

</script>

<template>
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3 ml-5 text-center">Движение товаров</h1>
        </div>
    </div>


    <div class="row ml-5">
        <div class="col-4">
            <label for="customer">Выберите склад</label>
            <select v-model="warehouse_id" class="form-control">
                <option v-bind:value="null">Все</option>
                <option v-for="warehouse in warehouses" v-bind:value="warehouse.id" > {{warehouse.name}}</option>
            </select>
        </div>
        <div class="col-4">
            <label for="customer">Выберите статус</label>
            <select v-model="status" class="form-control">
                <option v-bind:value="null">Все</option>
                <option value="Списание" > Списание</option>
                <option value="Поступление" > Поступление</option>
            </select>
        </div>
        <div class="col-4">
            <label for="customer">Выберите продукт</label>
            <select v-model="product_id" class="form-control">
                <option v-bind:value="null">Все</option>
                <option v-for="product in allProducts" v-bind:value="product.id" > {{product.name}}</option>

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
        <div class="col-4">
            <label for="date">Выберите дату</label>
            <input type="date" v-model="dateMovement" class="form-control"  id="date">


        </div>
        <div class="col-4">
            <div class="text-center mt-2">
            <a href="#" @click.prevent="getMovement(1)" class="btn btn-success mt-3 ">Применить</a>
            </div>
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
    <div class="row">
        <div class="col-12 d-flex justify-content-center wow fadeInUp animated">
            <ul class="pagination">
                <li v-if="pagination.current_page !==1" class="page-item">
                    <a @click.prevent="getMovement(pagination.current_page-1)" class="page-link" href="#" aria-label="Previous">
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
                        <a @click.prevent="getMovement(link.label)" :class="link.active? 'active': ''" class="page-link"
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
                    <a @click.prevent="getMovement(pagination.current_page+1)" class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
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
            movements: [],
            status: null,
            allProducts:null,
            product_id: null,
            warehouses: null,
            warehouse_id: null,
            paginate: 10,
            pagination:[],
            dateMovement: null,

        }
    },
    mounted() {
        this.getMovement();
        this.getWarehouse();
        this.getAllProduct();
    },
    methods: {
        getMovement(page=1) {
            axios.post('/api/v1/movements' , {
                'warehouse_id':this.warehouse_id,
                'status':this.status,
                'product_id':this.product_id,
                'date': this.dateMovement,
                'paginate':this.paginate,
                'page':page,
            })
                .then(res => {
                    this.movements = res.data.data
                    this.pagination = res.data.meta
                    console.log(res);
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
