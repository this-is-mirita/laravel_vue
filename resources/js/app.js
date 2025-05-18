import {createApp} from 'vue'
import PostComponent from "@/components/PostComponent.vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';

const app = createApp({})
app.component('PostComponent', PostComponent);
app.use(Toast);
app.mount('#app');
