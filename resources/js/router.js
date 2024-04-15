import { createMemoryHistory, createRouter } from 'vue-router'

const routes = [
    {
        // path: '/add',
        // name: 'credentials.add'
    },
    {
        // path: '/',
        // name: 'credentials.list'
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});
export default router;
