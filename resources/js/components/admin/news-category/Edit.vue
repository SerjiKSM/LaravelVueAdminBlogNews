<template>
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update news category</h3>
                    </div>
                    <form role="form" @submit.prevent="updateNewsCategory()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryId">Update news category</label>
                                <input type="text" class="form-control" id="categoryId" placeholder="Add news category"
                                       v-model="form.title" name="title"
                                       :class="{ 'is-invalid': form.errors.has('title') }"
                                >
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="descriptionId">Add New Description</label>
                                <textarea type="text" class="form-control" id="descriptionId"
                                          placeholder="Add New Description"
                                          v-model="form.description" name="description"
                                          :class="{ 'is-invalid': form.errors.has('description') }">
                                </textarea>
                                <has-error :form="form" field="description"></has-error>
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
    export default {
        name: "edit",
        data() {
            return {
                form: new Form({
                    title: '',
                    description: ''
                })
            }
        },
        mounted() {
            axios.get(`/edit-category/${this.$route.params.categoryid}`)
                .then((response) => {
                    this.form.fill(response.data.category)
                })
                .catch((e) => {
                    this.$swal(e.response.data.message || 'There was an issue.', {
                        icon: "error",
                    });
                    console.log(e);
                    this.$router.push('/category-list')
                })
        },
        methods: {
            updateNewsCategory() {
                this.form.post(`/update-category/${this.$route.params.categoryid}`)
                    .then((response) => {
                        this.$swal("News category updated successfully!", {
                            icon: "success",
                        });

                        this.$router.push('/category-list')
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
