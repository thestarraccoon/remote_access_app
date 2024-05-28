import { createMemoryHistory, createRouter } from 'vue-router'

const routes = [
    {
        path: '/auth',
        component: () => import('./components/Auth/Login.vue'),
        name: 'login'
    },
    {
        path: '/register',
        component: () => import('./components/Auth/Register.vue'),
        name: 'register'
    },
    {
        path: '/',
        component: () => import('./components/MainTable.vue'),
        name: 'main',
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});

// router.beforeEach((to, from, next) => {
//     axios.get('/api/checkauth')
//         .then(response => {
//             const hasAccess = response.data.isAuth;
//             console.log(hasAccess);
//             if (hasAccess) {
//                 next();
//             } else {
//                 next('/auth'); // if route "to"....
//             }
//         })
//         .catch(error => {
//             console.error('Ошибка при получении данных:', error);
//         });
// });
export default router;
