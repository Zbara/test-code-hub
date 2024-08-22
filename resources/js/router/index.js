import {
    createRouter,
    createWebHistory
} from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/login",
            name: "login",
            component: () => import("../pages/Login.vue"),
        },

        {
            path: "/",
            name: "main",
            component: () => import("../pages/Main.vue"),
        },
        {
            path: '/:pathMatch(.*)*',
            component: () => import("../pages/Error/Error-404.vue"),
        },
    ],
});


router.beforeEach((to, from, next) => {
    const publicPages = ['/login'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem('token-admin');

    if (authRequired && !loggedIn) {
        next('/admin/login');
    } else {
        next();
    }
});

export default router;
