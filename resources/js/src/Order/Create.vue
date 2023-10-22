<script setup>

</script>

<template>
    <div class="row ml-3">
        <h1 class="mt-3 ml-2">Создать заказ</h1>
    </div>
    <div class="w-25 ml-5">
        <div class="mb-3">
            <label for="customer">Клиент</label>
            <input type="text" class="form-control" id="customer" v-model="customer">
        </div>
        <div class="mb-3">
            <label for="customer">Выберите склад</label>
            <select v-model="warehouse_id" class="form-control">
                <option disabled value="">Выберите один из вариантов</option>
                <option v-for="warehouse in warehouses" v-bind:value="warehouse.id" > {{warehouse.name}}</option>
            </select>
        </div>
        <a href="#" @click.prevent="createOrder(customer, warehouse_id)" class="btn btn-success mt-2">Создать</a>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "OrderIndex",

    data() {
        return {
            customer: null,
            warehouses: null,
            warehouse_id: null,

        }
    },
    mounted() {
        this.getWarehouse()
    },
    methods:{
        getWarehouse() {
            axios.get('/api/v1/warehouses')
                .then(res => {
                    this.warehouses = res.data.data;
                })
        },
        createOrder(customer, warehouse_id){
            axios.post('/api/v1/order/create', {customer:customer, warehouse_id:warehouse_id})
                .then(res => {
                    this.$router.push('/order');
                })

        }
    }
}

</script>

<style scoped>

</style>
