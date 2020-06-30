<template>
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">News</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="box-body">
                            <p>Category - {{categoryTitle}}</p>
                            <p>{{news.title}}</p>

                            <img class="img-responsive pad" :src="showImage(news.image)" alt="Photo">

                            <p>{{news.description}}</p>
                            <p>{{news.date}}</p>

                            <span class="pull-right text-muted">number of views - {{number_views}}</span>
                        </div>

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
        name: "news",
        data() {
            return {
                news: {},
                categoryTitle: '',
                number_views: '',
            }
        },
        methods: {
            getNews() {
                axios.get(`news/${this.$route.params.newsid}`)
                    .then((data) => {
                        this.news = data.data.news;
                        this.categoryTitle = this.news.news_category.title;
                    })
                    .catch((e) => {
                        this.$swal(e.response.data.message || 'There was an issue.', {
                            icon: "error",
                        });
                        console.log(e);
                        this.$router.push('/category-list')
                    })
            },
            showImage(img) {
                if (img !== null) return "uploadImage/" + img;
            },
        },
        created() {
            this.getNews();
        },
        beforeMount() {
            axios.post(`update-number-views/${this.$route.params.newsid}`)
                .then((data) => {
                    this.number_views = data.data.news.number_views;
                })
                .catch((e) => {
                    console.log(e);
                })
        }
    }
</script>

<style scoped>

</style>
