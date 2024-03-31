import { createMemoryHistory, createRouter } from 'vue-router'

const routes = [
    {
        // path: '/',
        // component: () => import('./components/Index.vue'),
        // name: 'index'
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});
export default router;
