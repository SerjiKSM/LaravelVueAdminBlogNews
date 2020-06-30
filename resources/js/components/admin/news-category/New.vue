<template>
    <section class="content">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add news category</h3>
                    </div>
                    <form role="form" @submit.prevent="addNewsCategory()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryId">Add news category</label>
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
        name: "new",
        data() {
            return {
                form: new Form({
                    title: '',
                    description: ''
                })
            }
        },
        methods: {
            addNewsCategory() {
                this.form.post('/add-category')
                    .then((response) => {
                        this.$router.push('/category-list')

                        this.$swal("Category added successfully!", {
                            icon: "success",
                        });

                    })
                    .catch((e) => {
                        console.log(e.response.data.message || 'There was an issue creating the news category.');
                    })
            },
        }
    }
</script>

<style scoped>

</style>
