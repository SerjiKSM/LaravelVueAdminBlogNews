<template>
    <div class="container">

        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">

                            <li class="nav-item">
                                <router-link to="/category-list" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Category
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/news-list" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        News
                                    </p>
                                </router-link>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                </div>
                <div class="info">

                </div>

            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2 justify-content-center">
                            <h3>{{ title }}</h3>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <router-view></router-view>

            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- ./wrapper -->

    </div>
</template>

<script>
    import userData from '../../userData';

    export default {
        name: "app",
        data() {
            return {
                isAdmin: false,
                title: false,
            }
        },
        methods: {
            getUserType() {
                userData.getUserData()
                    .then((response) => {
                        if (response.data.user_type == "admin") this.title = "Admin cabinet";
                        if (response.data.user_type == "user") this.title = "User cabinet";
                    })
                    .catch((e) => {
                        console.log(e);
                    })
            }
        },
        created() {
            this.getUserType();
        },
    }
</script>

<style scoped>

</style>
