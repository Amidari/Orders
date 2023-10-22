<template>

    <div class="row">
        <h1 class="col mt-3">Склады</h1>

    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Склад</th>
            <th scope="col">Именить</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <template v-for="warehouse in warehouses">
            <tr :class="isEdit(warehouse.id)? 'd-none' : ''">
                <th>{{ warehouse.id }}</th>
                <td>{{ warehouse.name }}</td>
                <td><a href="#" @click.prevent="changeEditWarehouseId(warehouse.id, warehouse.name)" class="btn btn-success">Именить</a></td>
                <td><a href="#" @click.prevent="deleteWarehouse(warehouse.id)" class="btn btn-danger">Удалить</a></td>
            </tr>
            <tr :class="isEdit(warehouse.id)? '' : 'd-none'">
                <th>{{ warehouse.id }}</th>
                <td><input type="text" class="form-control" v-model="name"></td>
                <td><a href="#" @click.prevent="updateWarehouse(warehouse.id)" class="btn btn-success">Сохранить</a></td>
            </tr>
        </template>
        <tr>
            <td></td>
            <td><input type="text" class="form-control" id="name" v-model="addName" placeholder="Склад"></td>
            <td><a href="#" @click.prevent="addWarehouse" class="btn btn-success">Добавить</a></td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "WarehouseIndex",

    data() {
        return {
            warehouses: null,
            editWarehouseId: null,
            name: null,
            addName: null,
        }
    },

    mounted() {
        this.getWarehouse()
    },

    methods: {
        getWarehouse() {
            axios.get('api/v1/warehouses')
                .then(res => {
                    this.warehouses = res.data.data;
                })
        },
        updateWarehouse(id){
            this.editWarehouseId = null;
            axios.post(`api/v1/warehouses/${id}/update`, {name: this.name})
                .then(res => {
                    this.getWarehouse()
                })

        },
        addWarehouse(){
            axios.post(`api/v1/warehouses/`, {name: this.addName})
                .then(res => {
                    this.getWarehouse()
                })

        },
        deleteWarehouse(id){
            this.editWarehouseId = null;
            axios.post(`api/v1/warehouses/${id}/delete`)
                .then(res => {
                    this.getWarehouse()
                    this.addName = null;
                })

        },
        changeEditWarehouseId(id, name) {
            this.editWarehouseId = id
            this.name = name

        },

        isEdit(id){
            return this.editWarehouseId === id
        }
    },
}
</script>

<script setup>

</script>

<style scoped>

</style>
