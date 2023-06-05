<template>
    <div v-if="datos" class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="nombre" class="font-weight-bold">Nombre:</label>
                <span id="nombre" class="d-block mt-2">{{ datos.nombre }}</span>
            </div>

            <div class="form-group">
                <label for="primer-apellido" class="font-weight-bold">Primer Apellido:</label>
                <span id="primer-apellido" class="d-block mt-2">{{ datos.primer_apellido }}</span>
            </div>

            <div class="form-group">
                <label for="segundo-apellido" class="font-weight-bold">Segundo Apellido:</label>
                <span id="segundo-apellido" class="d-block mt-2">{{ datos.segundo_apellido }}</span>
            </div>

            <div class="form-group">
                <label for="calle" class="font-weight-bold">Calle:</label>
                <span id="calle" class="d-block mt-2">{{ datos.calle }}</span>
            </div>

            <div class="form-group">
                <label for="numero" class="font-weight-bold">Numero:</label>
                <span id="numero" class="d-block mt-2">{{ datos.numero }}</span>
            </div>

            <div class="form-group">
                <label for="colonia" class="font-weight-bold">Colonia:</label>
                <span id="colonia" class="d-block mt-2">{{ datos.colonia }}</span>
            </div>

            <div class="form-group">
                <label for="codigo-postal" class="font-weight-bold">Codigo Postal:</label>
                <span id="codigo-postal" class="d-block mt-2">{{ datos.codigo_postal }}</span>
            </div>

            <div class="form-group">
                <label for="telefono" class="font-weight-bold">Telefono:</label>
                <span id="telefono" class="d-block mt-2">{{ datos.telefono }}</span>
            </div>

            <div class="form-group">
                <label for="rfc" class="font-weight-bold">RFC:</label>
                <span id="rfc" class="d-block mt-2">{{ datos.rfc }}</span>
            </div>

            <div class="form-group">
                <label for="status" class="font-weight-bold">Status:</label>
                <span id="status" class="d-block mt-2">{{ datos.status }}</span>
            </div>

            <div class="form-group" v-if="datos.status === 'Rechazado'">
                <label for="observacion" class="font-weight-bold">Observacion:</label>
                <span id="observacion" class="d-block mt-2">{{ datos.observacion }}</span>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
                <label for="archivo" class="font-weight-bold">Documentos:</label>
                <ul class="mt-2">
                <li v-for="documento in datos.archivo" :key="documento.id">
                    <a :href="'/download/' + encodeURIComponent(documento.nombre)">{{ documento.nombre }}</a>
                </li>
                </ul>
            </div>

            <button @click="cambiarRuta" class="btn btn-danger mt-3">Salir</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['id'],

    data() {
        return {
            datos: null, 
        };
    },
    mounted() {
 
    this.obtenerDatos();
    },
    methods: {
        obtenerDatos() {
            axios.get(`informacion-obtener/${this.id}`)
            .then(response => {
                this.datos = response.data;
                console.log( this.datos);
            })
            .catch(error => {
                console.error(error);
            });
        },
        cambiarRuta() {
                window.location.href = '/';
        },
    },
}
</script>

<style>
 label{
    font-weight: bolder;
 }
</style>