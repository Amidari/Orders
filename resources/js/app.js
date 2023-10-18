import './bootstrap';

import {createApp} from 'vue'
import {createRouter, createWebHistory} from "vue-router";

import App from './src/App.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [{
            name: 'product.index',
            path: '/product', component: () => import("./src/Product/Index.vue"),
        },
        {
            name: 'order.index',
            path: '/order', component: () => import("./src/Order/Index.vue"),
        },
        {
            name: 'warehouse.index',
            path: '/warehouse', component: () => import("./src/Warehouse/Index.vue"),
        }],
});
const app = createApp(App).use(router).mount("#app")
