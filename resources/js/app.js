import { createApp } from 'vue';
import PageTreeComponent from './components/PageTreeComponent.vue';

const app = createApp({});
app.component('page-tree-component', PageTreeComponent);
app.mount('#app');
