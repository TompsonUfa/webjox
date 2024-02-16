import router from "@/router/router.js";

export default {
    actions: {
        checkAuth(ctx) {
            return axios.get('/api/user')
                .then(res => {
                    ctx.commit('updateUser', res.data.data)
                    ctx.commit('updateAuthenticated', true)
                })
                .catch(err => {
                    ctx.dispatch('logout');
                });
        },
        login(ctx) {
            return axios.get('/api/user').then(res => {
                ctx.commit('updateUser', res.data.data)
                ctx.commit('updateAuthenticated', true)
                router.push({name: 'admin'})
            }).catch(err => {
                ctx.dispatch('logout');
            })
        },
        logout(ctx) {
            axios.post('/logout').then(res => {
                ctx.commit('updateUser', {})
                ctx.commit('updateAuthenticated', false)
                router.push({name: 'auth'})
            })
        }
    },
    mutations: {
        updateAuthenticated(state, value) {
            state.authenticated = value
        },
        updateUser(state, value) {
            state.user = value
        }
    },
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
}
