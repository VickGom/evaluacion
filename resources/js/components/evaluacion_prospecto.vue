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
            <div class="form-group">
              <label v-if="datos.status === 'Rechazado'" for="observacion">Observacion</label>
              <span v-if="datos.status === 'Rechazado'" id="observacion" class="d-block mt-2">{{ datos.observacion }}</span>
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

            <div class="form-group">
                <label for="observacion">Observacion:</label>
                <textarea id="observacion" v-model="observacion" rows="4" cols="50" class="form-control d-block mt-2"></textarea>
                <h7 v-if="show" class="op">Debe de llenar este campo si quiere rechazar al prospecto</h7>
            </div>
            <br>
            <div class="form-group">
              <button @click="rechazar" class="btn btn-danger custom-button">Rechazar</button>
              <button @click="aceptar" class="btn btn-primary custom-button">Aceptar</button>
              <button @click="cambiarRuta" class=" btn btn-warning custom-button">Salir</button>
            </div>
            </div>
        </div>
    </div>

          <!-- Modal de aceptado-->
    <div class="modal" :class="{ 'is-active': showModal }">
      <div class="modal-background"></div>
        <div class="modal-content">

            <div class="">
            <h3>Operacion exitosa</h3>
            <button  class="btn btn-success" @click="cambiarRuta">Ok!!</button>
            </div>
        </div>
      <button class="modal-close is-large" aria-label="close" @click="closeModal"></button>
    </div>
</template>

<script>
export default {
  props: ['id'],

  data() {
      return {
          datos: null, 
          observacion: "",
          show: false,
          showModal: false,
      };
  },
  mounted() {

  this.obtenerDatos();
  },
  methods: {
      openModal() {
          this.showModal = true;
      },
      closeModal() {
          this.showModal = false;
      },
      obtenerDatos() {
          axios.get(`../informacion/informacion-obtener/${this.id}`)
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
      aceptar() {
        const formData = new FormData();
        formData.append('id', this.id);
        formData.append('status', "Aceptado");
          axios.post(`/cambiar-status`, formData)
          .then(response => {
              this.openModal();
          })
          .catch(error => {
              console.error(error);
          });
      },
      rechazar() {
        const formData = new FormData();
        formData.append('id', this.id);
        formData.append('observacion', this.observacion);
        if (this.observacion === "") {
          this.show = true;
        } else {
          axios.post(`/cambiar-status`, formData)
            .then(response => {
                this.openModal();
            })
            .catch(error => {
                console.error(error);
            });
        }
      },
},
}
</script>

<style>
  .custom-button {
    margin-right: 10px; /* Ajusta el valor del margen según tus necesidades */
  }
  .op{
    color: rgb(255, 45, 45);
  }

  .modal {
    display: none;
  }

    .modal.is-active {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 4px;
    }

    .modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    }
</style>