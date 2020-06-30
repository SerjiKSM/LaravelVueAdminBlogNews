<template>
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add news</h3>
                    </div>
                    <form role="form" @submit.prevent="addNews()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="titleId">Add news</label>
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
                                <img :src="form.image" alt="" width="80" height="80">
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
                                <select class="form-control" :class="{ 'is-invalid': form.errors.has('categoryId') }"
                                        v-model="form.categoryId">
                                    <option disabled value="">Select One</option>
                                    <option :value="category.id" v-for="category in categories">option
                                        {{category.title}}
                                    </option>

                                </select>
                                <has-error :form="form" field="categoryId"></has-error>
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
        name: "new",
        components: {
            vuejsDatepicker
        },
        data() {
            return {
                form: new Form({
                    title: '',
                    description: '',
                    image: '',
                    date: '',
                    categoryId: '',
                }),
                categories: {},
            }
        },
        methods: {
            addNews() {
                this.form.post('/add-news')
                    .then(() => {
                        this.$router.push({name: 'news.list'});

                        this.$swal("News added successfully!", {
                            icon: "success",
                        });
                    })
                    .catch((e) => {
                        this.$swal(e.response.data.message || 'There was an issue creating the news.', {
                            icon: "error",
                        });

                        console.log(e.response.data.message || 'There was an issue creating the news.');
                    })
            },
            changeImage(event) {
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.image = event.target.result
                };
                reader.readAsDataURL(file);
            },
            getAllCategory() {
                axios.get("categories")
                    .then((data) => {
                        this.categories = data.data.categories;
                    })
                    .catch((e) => {
                        console.log(e);
                    })
            }
        },
        created() {
            this.getAllCategory();
        },
    }
</script>

<style scoped>

</style>
