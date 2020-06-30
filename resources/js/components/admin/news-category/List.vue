<template>
    <!--<div>-->
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category list</h3>
                        <div class="card-tools">
                            <button class="btn btn-primary" v-if="isAdmin">
                                <router-link to="/add-category" style="color: #FFF">Add news category</router-link>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th v-if="isAdmin">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="category in getAllCategory">
                                <td>
                                    <router-link :to="`/news-by-category/${category.id}`" class="">
                                        {{category.title}}
                                    </router-link>
                                </td>
                                <td>{{category.description}}</td>
                                <td v-if="isAdmin">
                                    <router-link :to="`/edit-category/${category.id}`" class="btn btn-primary">
                                        Edit
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <!--</div>-->
</template>

<script>
    import userData from '../../../userData';

    export default {
        name: "list",
        data() {
            return {
                isAdmin: false,
            }
        },
        methods: {
            getUserType() {
                userData.getUserData()
                    .then((response) => {
                        if (response.data.user_type == "admin") {
                            this.isAdmin = true;
                        }
                    })
                    .catch((e) => {
                        console.log(e);
                    })
            },
        },
        created() {
            this.getUserType();
        },
        mounted() {
            this.$store.dispatch("allCategory")
        },
        computed: {
            getAllCategory() {
                return this.$store.getters.getCategory
            }
        },
    }
</script>

<style scoped>

</style>
