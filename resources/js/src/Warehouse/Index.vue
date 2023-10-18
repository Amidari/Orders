<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Склад</th>
        </tr>
        </thead>
        <tbody>
        <template v-for="warehouse in warehouses">
            <tr>
                <th>{{ warehouse.id }}</th>
                <td>{{ warehouse.name }}</td>
                <td><a href="#" @click.prevent="changeEditWarehouseId(warehouse.id, warehouse.name)" class="btn btn-success">Именить</a></td>
            </tr>
            <tr :class="isEdit(warehouse.id)? '' : 'd-none'">
                <td>{{ warehouse.id }}</td>
                <td><input type="text" class="form-control" v-model="name"></td>
                <td><a href="#" @click.prevent="changeEditWarehouseId(null)" class="btn btn-success">Сохранить</a></td>
            </tr>
        </template>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "WarehouseIndex",

    data() {
        return {
            warehouses: null,
            editWarehouseId: null,
            name: null,
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
