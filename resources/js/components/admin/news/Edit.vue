<template>
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update news</h3>
                    </div>
                    <form role="form" @submit.prevent="updateNews()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="titleId">Update news</label>
                                <input type="text" class="form-control" id="titleId" placeholder="Add news"
                                       v-model="form.title" name="title"
                                       :class="{ 'is-invalid': form.errors.has('title') }"
                                >
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="descriptionId">Add description</label>
                                <textarea type="text" class="form-control" id="descriptionId"
                                          placeholder="Add New Description"
                                          v-model="form.description" name="description"
                                          :class="{ 'is-invalid': form.errors.has('description') }">
                                </textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <input @change="changeImage($event)" name="image" type="file"
                                       :class="{ 'is-invalid': form.errors.has('image') }">
                                <img :src="updateImage()" alt="img" width="80" height="80">
                                <has-error :form="form" field="image"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <vuejs-datepicker
                                    format="dd/MM/yyyy"
                                    placeholder="Add Date"
                                    clear-button-icon="true"
                                    v-model="form.date"
                                    :class="{ 'is-invalid': form.errors.has('date') }">
                                </vuejs-datepicker>
                                <has-error :form="form" field="date"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Select</label>
                                <select class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }"
                                        v-model="form.category_id">
                                    <option disabled value="">Select One</option>
                                    <option :value="category.id" v-for="category in getAllCategory">
                                        {{category.title}}
                                    </option>
                                </select>
                                <has-error :form="form" field="category_id"></has-error>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</template>

<script>
    import vuejsDatepicker from 'vuejs-datepicker';
    export default {
        name: "edit",
        components: {
            vuejsDatepicker
        },
        data() {
            return {
                form: new Form({
                    title: '',
                    description: '',
                    image: '',
                    category_id: '',
                    date: '',
                })
            }
        },
        mounted() {
            this.$store.dispatch("allCategory")
        },
        computed: {
            getAllCategory() {
                return this.$store.getters.getCategory
            }
        },
        created() {
            axios.get(`edit-news/${this.$route.params.newsid}`)
                .then((response) => {
                    this.form.fill(response.data.news)
                })
                .catch((e) => {
                    this.$swal(e.response.data.message || 'There was an issue.', {
                        icon: "error",
                    });
                    console.log(e);
                    this.$router.push('/news-list')
                })
        },
        methods: {
            changeImage(event) {
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.image = event.target.result
                };
                reader.readAsDataURL(file);
            },
            updateImage() {
                let img = this.form.image;
                if (img.length > 100) {
                    return this.form.image
                } else {
                    return `/uploadImage/${this.form.image}`;
                }
            },
            updateNews() {
                this.form.post(`update-news/${this.$route.params.newsid}`)
                    .then(()=>{
                        this.$router.push('/news-list')

                        this.$swal("News Updated successfully!", {
                            icon: "success",
                        });
                    })
                    .catch((e) => {
                        console.log(e);
                    })
            }
        }

    }
</script>

<style scoped>

</style>
