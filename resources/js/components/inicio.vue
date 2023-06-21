<template>
  <div class="container-custom">
    <div class="container d-flex justify-content-center align-items-center vh-100 mt-5">
        <div class="card">
          <div class="card-body">
              <div class="form-group">
                <label for="name">Sku:</label>
                <input type="number" v-model="sku" id="sku" name="sku" class="form-control" placeholder="Ingrese el Sku">
              </div>
              <div class="error-message" v-if="errors.length > 0">
                <ul>
                  <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
              </div>
              <div class="form-group text-center mt-3">
                <button @click="buscar" class="btn btn-primary">Buscar</button>
              </div>
          </div>
        </div>
    </div>

    <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Sku</th>
            <th>Artículo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Departamento</th>
            <th>Clase</th>
            <th>Familia</th>
            <th>Stock</th>
            <th>Cantidad</th>
            <th>Descontinuado</th>
            <th>Fecha de Alta</th>
            <th>Fecha Baja</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="articulo in articulos" :key="articulo.id">
            <td>{{ articulo.sku }}</td>
            <td>{{ articulo.articulo }}</td>
            <td>{{ articulo.marca }}</td>
            <td>{{ articulo.modelo }}</td>
            <td>{{ articulo.departamento }}</td>
            <td>{{ articulo.clase }}</td>
            <td>{{ articulo.familia }}</td>
            <td>{{ articulo.stock }}</td>
            <td>{{ articulo.cantidad }}</td>
            <td v-if="articulo.descontinuado == 1">Si</td>
            <td v-else>No</td>
            <td>{{ articulo.fechaDeAlta }}</td>
            <td>{{ articulo.fechaBaja }}</td>
          </tr>
        </tbody>
      </table>
    </div>
 </div>
  <div v-if="showModalV" class="modal">
      <div class="modal-content">
        <h3>Sku encontrado</h3>
        <p>¿Desea ingresar al articulo?</p>
        <button @click="redirigirMostrar" class="btn btn-primary">Ok!!</button>
        <button @click="showModalV = false" class="btn btn-danger mt-3">No</button>
      </div>
  </div>

  <div v-if="showModalF" class="modal">
      <div class="modal-content">
        <h3>Sku no encontrado</h3>
        <p>¿Desea agregar un articulo con este Sku?</p>
        <button @click="redirigirAgregar" class="btn btn-primary">Ok!!</button>
        <button @click="showModalF = false" class="btn btn-danger mt-3">No</button>
      </div>
  </div>

</template>

<script>
export default {
    data() {
        return {
          sku: "",
          showModalV: false,
          showModalF: false,
          errors: [],
          articulos:[
            {
              id: null,
              sku: null,
              articulo: null,
              marca: null,
              modelo: null,
              departamento: null,
              clase: null,
              familia: null,
              stock: null,
              cantidad: null,
              descontinuado: null,
              fechaDeAlta: null,
              fechaBaja: null
            }
          ],
        };
    },
    methods: {
        buscar() {

          if (this.sku.toString().length === 0) {
        
            this.errors.push("El SKU no puede estar vacío");
            return; 
          }
          if (this.sku.toString().length > 6) {
            
            this.errors.push("El SKU debe tener como máximo 6 caracteres");
            return; 
          }
          axios.get(`/buscar/${this.sku}`)
          .then(response => {
            if (response) {
              this.showModalV = true; 
            } 
          })
          .catch(error => {
            if (error) {
              this.showModalF = true; 
            }
          });
        },

        redirigirMostrar() {
          const url = `/articulo?sku=${this.sku}`; 
          window.location.href = url;
        },
        redirigirAgregar() {
          const url = `/agregar-articulo?sku=${this.sku}`; 
          window.location.href = url;
        }
    },

    mounted() {
      axios.get(`/mostrar-todo`)
            .then(response => {
            if (response) {
                this.articulos = response.data.articulo
                console.log(this.articulos);
                

            } 
            })
            .catch(error => {
        });
    },
}
</script>

<style>
    .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 300px; 
  }

  .close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
  }
  .container-custom {
    margin-top: -200px; 
  }

</style>