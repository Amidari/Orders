<template>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <p class="animation__shake">Админка</p>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link text-center">
                <span class="brand-text font-weight-light ">Админка</span>
            </a>


            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <router-link to="/product" class="nav-link text-white">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Продукты
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <RouterLink to="/order" class="nav-link text-white">
                                <i class="nav-icon fas fa-funnel-dollar"></i>
                                <p>
                                    Заказы
                                </p>
                            </RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink to="/warehouse" class="nav-link text-white">
                                <i class="nav-icon fas fa-solid fa-warehouse"></i>
                                <p>
                                    Склады
                                </p>
                            </RouterLink>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <RouterView />
        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

</template>

<script>
export default {

}
</script>

<script setup>

import MainComponent from "@/src/MainComponent.vue";

</script>

<style scoped>

</style>
