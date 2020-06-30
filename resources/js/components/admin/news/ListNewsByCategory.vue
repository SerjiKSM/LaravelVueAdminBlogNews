<template>
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">News list by category</h3>
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
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="news in newsData">
                                <td>
                                    <router-link :to="`/news/${news.id}`" class="">
                                        {{news.title}}
                                    </router-link>
                                </td>
                                <td>{{news.description}}</td>
                                <td>
                                    <img :src="showImage(news.image)" alt="image" width="40" height="50">
                                </td>
                                <td>
                                    {{news.date}}
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
    export default {
        name: "list-news-by-category",
        data() {
            return {
                newsData: {},
            }
        },
        methods: {
            showImage(img) {
                if (img !== null) return "uploadImage/" + img;
            },
            getNewsByCategory() {
                axios.get(`news-by-category/${this.$route.params.categoryid}`)
                    .then((data) => {
                        this.newsData = data.data.news;
                    })
                    .catch((e) => {
                        console.log(e);
                    })
            },
        },
        created() {
            this.getNewsByCategory();
        },

    }
</script>

<style scoped>

</style>
