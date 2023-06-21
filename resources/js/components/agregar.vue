<template>
      <div class="d-flex justify-content-center">
        <div class="col-md-6">
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="number" class="form-control" id="sku" v-model="articulo.sku" readonly/>
        </div>
        <div class="form-group">
            <label for="articulo">Artículo</label>
            <input type="text" class="form-control" id="articulo" v-model="articulo.articulo" />
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" v-model="articulo.marca" />
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" v-model="articulo.modelo" />
        </div>
        <div class="form-group">
            <label for="modelo">Departamento</label>
            <select class="form-control" v-model="selectedDepartamento" @change="obtenerClase">
                <option :value="null">Seleccione</option>
                <option v-for="departamento in departamentos" :value="departamento.id" :key="departamento.id">
                    {{ departamento.nombreDepartamento }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="modelo">Clase</label>
            <select class="form-control" v-model="selectedClase"  :disabled="esDisabled" @change="obtenerFamilia">
                <option :value="null">Seleccione</option>
                <option v-for="clase in clases" :value="clase.numeroClase" :key="clase.numeroClase">
                    {{ clase.nombreClase }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="modelo">Familia</label>
            <select class="form-control" v-model="selectedFamilia" :disabled="esDisabledF">
                <option :value="null">Seleccione</option>
                <option v-for="familia in familias" :value="familia.id" :key="familia.id">
                    {{ familia.nombreFamilia }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" v-model="articulo.stock" />
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" v-model="articulo.cantidad" />
        </div>
        </div>
    </div>
    <div class="error-message" v-if="errors.length > 0">
        <ul>
            <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
    </div>
    <div class="d-flex justify-content-center gap-2 mt-3">
        <button class="btn btn-primary" @click="agregar">Agregar</button>
        <button class="btn btn-secondary" @click="salirModal">Salir</button>
    </div>

    <div v-if="showModalV" class="modal">
      <div class="modal-content">
        <h3>Salir</h3>
        <p>¿Desea salir?, Se perderan todos los datos</p>
        <button @click="salir" class="btn btn-primary">Ok!!</button>
        <button @click="showModalV = false" class="btn btn-danger mt-3">No</button>
      </div>
  </div>
  <div class="d-flex justify-content-center">
        <div v-if="showModalF" class="modal">
            <div class="modal-content">
                <h3>Articulo agregado</h3>
                <button @click="salir" class="btn btn-primary">Ok!!</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['sku'],
    data() {
        return {
            articulo: {
                sku: null,
                articulo: null,
                marca: null,
                modelo: null,
                departamento: null,
                clase: null,
                familia: null,
                stock: null,
                cantidad: null,
                fechaDeAlta: null,
                fechaBaja: null,
            },
            selectedDepartamento: null,
            departamento: null,
            clase: null,
            familia: null,
            departamentos: [],
            clases: [],
            familias: [],
            selectedFamilia: null,
            selectedClase: null,
            esDisabled: true,
            esDisabledF: true,
            showModalV: false,
            showModalF: false,
            errors: [],

        };
    },
    created() {
        this.articulo.sku = this.sku;
    },
    mounted() {
            axios.get(`/mostrar-departamento`)
            .then(response => {
                    if (response) {
                        this.departamentos = response.data.departamentos
                    } 
                    })
                    .catch(error => {

                    });

    },
    methods: {
        obtenerClase() {
            if (this.selectedDepartamento) {

                axios.get(`/mostrar-clase/${this.selectedDepartamento}`)
            .then(response => {
                    if (response) {
                        this.clases = response.data.clases
                        this.habilitarSelectClase();

                    } 
                    })
                    .catch(error => {
            });

            }
            
        },
        obtenerFamilia() {
            if (this.selectedClase) {

                axios.get(`/mostrar-familia/${this.selectedClase}`)
            .then(response => {
                    if (response) {
                        this.familias = response.data.familias
                        this.habilitarSelectFamilia();
                    } 
                    })
                    .catch(error => {
            });

            }
            
        },
        salirModal(){
            this.showModalV = true;
        },

        salir(){
            const url = `/`; 
            window.location.href = url;
        },

        habilitarSelectClase() {
            this.esDisabled = false; 
        },
        habilitarSelectFamilia() {
            this.esDisabledF = false; 
        },

        agregar() {
            if (this.articulo.cantidad > this.articulo.stock) {
                this.errors.push("La cantidad no debe ser mayor al stock");
                return; 
            }
            axios.post('/agregar', {
                ...this.articulo,
                selectedDepartamento: this.selectedDepartamento,
                selectedFamilia: this.selectedFamilia,
                selectedClase: this.selectedClase
            })
            .then(response => {
                console.log(response.data);
                this.showModalF = true;
            })
            .catch(error => {
            });
            
        },
        
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
</style>