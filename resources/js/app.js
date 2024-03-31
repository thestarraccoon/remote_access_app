import './bootstrap';
import { createApp } from 'vue';
import router from './router.js'

const app = createApp({});

import IndexComponent from './components/Index.vue';
app.component('index-component', IndexComponent);

app.use(router).mount('#app');
