import './bootstrap';

import {createApp} from 'vue'
import {createRouter, createWebHistory} from "vue-router";

import ProductComponent from "./src/product/ProductComponent.vue";
import OrderComponent from "./src/order/OrderComponent.vue";


import App from './src/App.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [{
        name: 'Product',
        path: '/product',
        component: ProductComponent
    },
        {
            name: 'Order',
            path: '/order',
            component: OrderComponent
        }],
});
const app = createApp(App).use(router).mount("#app")
