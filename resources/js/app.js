require('./bootstrap');
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';

import { createApp } from 'vue';

import Inicio from './components/inicio.vue';
import Evaluar from './components/evaluacion_prospecto.vue';
import Capturar from './components/capturar_prospecto.vue';
import Informacion from './components/informacion.vue';

//Aqui se crea la aplicacion y carga todos los componentes que se utilizan

const app = createApp({
    components: {
        Inicio,
        Evaluar,
        Capturar,
        Informacion,
    }
});

app.mount('#app');