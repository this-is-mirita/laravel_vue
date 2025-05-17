import {createApp} from 'vue'
import PostComponent from "@/components/PostComponent.vue";

import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';

const app = createApp({})
app.component('PostComponent', PostComponent);
app.mount('#app');
