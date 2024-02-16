import {createRouter, createWebHistory} from "vue-router";
import routes from "@/router/routes.js";
import store from "@/store/index.js";

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes: routes,
})

router.beforeEach((to, from, next) => {

    if (to.meta.middleware === "guest") {
        if (store.state.auth.authenticated) {
            next({name: "admin"})
        }
        next();
    }
    if (to.meta.middleware === "auth") {
        store.dispatch('checkAuth');
        if (store.state.auth.authenticated) {
            if (to.name === 'create-post') {
                if (!store.state.auth.user.permissions.find(permission => permission.slug === 'create-tasks')) {
                    next({name: "admin"})
                }
            }
            if (to.name === 'update-post') {
                if (!store.state.auth.user.permissions.find(permission => permission.slug === 'update-tasks')) {
                    next({name: "admin"})
                }
            }
            next()
        } else {
            next({name: "auth"})
        }
    } else {
        next();
    }
});

export default router;
