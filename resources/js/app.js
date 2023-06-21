require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';

import { createApp } from 'vue';

import Inicio from './components/inicio.vue';
import Articulo from './components/articulo.vue';
import Agregar from './components/agregar.vue';


//Aqui se crea la aplicacion y carga todos los componentes que se utilizan

const app = createApp({
    components: {
        Inicio,
        Articulo,
        Agregar,
    }
});

app.mount('#app');