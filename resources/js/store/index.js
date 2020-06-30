export default {
    state: {
        category: [],
    },
    getters: {
        getCategory(state) {
            return state.category
        },
    },
    actions: {
        allCategory(context) {
            axios.get('/categories')
                .then((response) => {
                    context.commit('categoreis', response.data.categories)
                })
                .catch((e) => {
                    console.log(e);
                })
        },
    },
    mutations: {
        categoreis(state, data) {
            return state.category = data
        },
    }
}
