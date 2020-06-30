<template>
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">News list</h3>
                        <div class="card-tools">
                            <button class="btn btn-primary" v-if="isAdmin">
                                <router-link to="/add-news" style="color: #FFF">Add news</router-link>
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
                                <th>Image</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th v-if="isAdmin">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="news in newsData">
                                <td>{{news.title}}</td>
                                <td>{{news.description}}</td>
                                <td>
                                    <img :src="showImage(news.image)" alt="image" width="40" height="50">
                                </td>
                                <td>{{news.date}}</td>
                                <td>
                                    {{news.news_category.title}}
                                </td>
                                <td v-if="isAdmin">
                                    <router-link :to="`/edit-news/${news.id}`" class="btn btn-primary" v-if="isAdmin">
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
</template>

<script>
    import userData from '../../../userData';

    export default {
        name: "list",
        data() {
            return {
                newsData: {},
                isAdmin: false,
            }
        },
        methods: {
            getNews() {
                axios.get("news-list")
                    .then((data) => {
                        this.newsData = data.data.news;
                    })
                    .catch((e) => {
                        console.log(e);
                    })
            },
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
            showImage(img) {
                if (img !== null) return "uploadImage/" + img;
            },
        },
        created() {
            this.getNews();
            this.getUserType();
        },
    }
</script>

<style scoped>

</style>
