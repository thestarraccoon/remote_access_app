import './bootstrap';
import { createApp } from 'vue';
import router from './router.js'
import { VueClipboard } from '@soerenmartius/vue3-clipboard'

const app = createApp({});

import IndexComponent from './components/Index.vue';
app.component('index-component', IndexComponent);

app.use(router).use(VueClipboard).mount('#app');
