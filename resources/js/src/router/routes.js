import HomeLayout from "@/layouts/HomeLayout.vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import HomeView from "@/views/HomeView.vue";
import PostShowView from "@/views/Admin/Posts/ShowView.vue";
import AuthView from "@/views/AuthView.vue";
import AdminPostsView from "@/views/Admin/Posts/IndexView.vue";
import AdminCreatePostView from "@/views/Admin/Posts/CreateView.vue";
import AdminEditPostView from "@/views/Admin/Posts/EditView.vue";

const routes = [
    {
        path: '/',
        redirect: {name: 'home'},
        component: HomeLayout,
        children: [
            {
                path: '',
                name: 'home',
                component: HomeView,
            },
            {   path: '/posts/:id',
                name: 'post-show',
                component: PostShowView,

            }
        ]
    },
    {
        path: '/login',
        component: AuthView,
        name: 'auth',
        meta: {
            middleware: 'guest'
        },
    },
    {
        path: '/admin',
        component: AdminLayout,
        name: 'admin',
        meta: {
            middleware: 'auth',
        },
        redirect: {name: 'admin-posts'},
        children: [
            {
                path: 'posts',
                children: [
                    {
                        path: '',
                        component: AdminPostsView,
                        name: 'admin-posts',
                    },
                    {
                        path: 'create',
                        component: AdminCreatePostView,
                        name: 'create-post',
                    },
                    {
                        path: ':id',
                        component: AdminEditPostView,
                        name: 'update-post',
                    }
                ]
            },
        ],
    }
]

export default routes;
