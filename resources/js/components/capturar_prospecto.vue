.<template>
    <!-- Formulario-->
    <div class="container mx-5 my-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" v-model="nombre"  class="form-control" required>
                    <h7 v-if="errores.nombre" class="error">{{"Se requiere " + errores.nombre }}</h7>
                </div>
                <div class="form-group mb-3">
                    <label for="primer-apellido">Primer apellido</label>
                    <input type="text" id="primer-apellido" v-model="primerApellido" class="form-control" required>
                    <h7 v-if="errores.primer_apellido" class="error">{{"Se requiere " + errores.primer_apellido }}</h7>
                </div>
                <div class="form-group mb-3 ">
                    <label for="segundo-apellido">Segundo apellido</label>
                    <input type="text" id="segundo-apellido" v-model="segundoApellido" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="calle">Calle</label>
                    <input type="text" id="calle" v-model="calle" class="form-control" required>
                    <h7 v-if="errores.calle" class="error">{{"Se requiere " + errores.calle }}</h7>
                </div>
                <div class="form-group mb-3">
                    <label for="numero">Número</label>
                    <input type="text" id="numero" v-model="numero" class="form-control" required>
                    <h7 v-if="errores.numero" class="error">{{"Se requiere " + errores.numero }}</h7>
                </div>
                <div class="form-group mb-3">
                    <label for="colonia">Colonia</label>
                    <input type="text" id="colonia" v-model="colonia" class="form-control" required>
                    <h7 v-if="errores.colonia" class="error">{{"Se requiere " + errores.colonia }}</h7>
                </div>
                <div class="form-group mb-3">
                    <label for="codigo-postal">Código Postal</label>
                    <input type="text" id="codigo-postal" v-model="codigoPostal" class="form-control" required>
                    <h7 v-if="errores.codigo_postal" class="error">{{"Se requiere " + errores.codigo_postal }}</h7>
                </div>
                <div class="form-group mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" v-model="telefono" class="form-control" required>
                    <h7 v-if="errores.telefono" class="error">{{"Se requiere " + errores.telefono }}</h7>
                </div>
                <div class="form-group mb-3">
                    <label for="rfc">RFC</label>
                    <input type="text" id="rfc" v-model="rfc" class="form-control" required>
                    <h7 v-if="errores.rfc" class="error">{{"Se requiere " + errores.rfc }}</h7>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-success" @click="enviarDatos">Agregar</button>
                    <button class="btn btn-danger" @click="salir">Salir</button>
                </div>
            </div>
            <!-- Agregar Imagenes-->
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <h7 v-if="errores.archivos" class="error">{{"Se requiere " + errores.archivos }}</h7>
                </div>
                <div
                class="drop-area"
                @dragenter="manejarDragEnter"
                @dragover="manejarDragOver"
                @dragleave="manejarDragLeave"
                @drop="manejarDrop"        
                >
                <img v-if="documentos.length === 0" class="img-fluid" src="/img/save.png" alt="Imagen predeterminada" />
                <h2 v-if="documentos.length === 0">Arrastra tus archivos</h2>
                
                <div v-else>
                    <div v-for="(documento, index) in documentos" :key="index" class="text-left">
                        <div>
                            <img class="img-fluid" src="/img/archivo.png"/>
                        </div>
                        <strong class="mt-3">{{ documento.nombre }}</strong>
                        <div>
                            <button class="btn btn-danger"  @click="eliminarDocumento(index)">Eliminar</button>
                        </div>
                    </div>
                </div>
                <input  type="file" ref="fileInput" @change="handleFileInput" multiple style="display: none">
                    <br>
                <button  class="btn btn-primary" @click="openFileInput">Agregar Archivos</button>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal de agregar-->
    <div class="modal" :class="{ 'is-active': showModal }">
      <div class="modal-background"></div>
        <div class="modal-content">

            <div class="">
            <h3>Agregado con exito</h3>
            <button  class="btn btn-success" @click="cambiarRuta">Ok!!</button>
            </div>
        </div>
      <button class="modal-close is-large" aria-label="close" @click="closeModal"></button>
    </div>
        <!-- Modal de Salir-->
    <div class="modal" :class="{ 'is-active': showModall }">
      <div class="modal-background"></div>
        <div class="modal-content">

            <div class="">
            <h3>¿Seguro que quiere salir?</h3>
            <h4>Perdera los cambios al salir de esta pestaña</h4>
            <div class="d-flex justify-content-between">
                <button  class="btn btn-success" @click="quedarse">Seguir</button>
                <button  class="btn btn-warning" @click="cambiarRuta">Salir</button>
            </div>  
            </div>
        </div>
      <button class="modal-close is-large" aria-label="close" @click="closeModal"></button>
    </div>



</template> 

<script>
import axios from 'axios';
    export default {
        data() {
            return {
                nombre: '',
                primerApellido: '',
                segundoApellido: '',
                calle: '',
                numero: '',
                colonia: '',
                codigoPostal: '',
                telefono: '',
                rfc: '',
                documentos: [],
                archivos: [],
                errores: {},
                showModal: false,
                showModall: false,
            };
        },

        methods: {
            openModal() {
                this.showModal = true;
            },
            closeModal() {
                this.showModal = false;
            },
            obtenerUrlDocumento(archivo) {
                return URL.createObjectURL(archivo);
            },

            openFileInput() {
                this.$refs.fileInput.click();
            },

            handleFileInput(event) {
                const archivos = event.target.files;
                this.agregarArchivos(archivos);
            },
            //Aqui se agregan los archivos con el boton
            agregarArchivos(archivos) {
                for (let i = 0; i < archivos.length; i++) {
                    const archivo = archivos[i];
                    this.documentos.push({ nombre: archivo.name, archivo: archivo });
                }
            },
            
            eliminarDocumento(index) {
                this.documentos.splice(index, 1);
            },

            cambiarRuta() {
                window.location.href = '/';
            },

            salir() {
                this.showModall = true;
            },

            quedarse() {
                this.showModall = false;
            },

            manejarDragEnter(event) {
                event.preventDefault();
                event.stopPropagation();
            },

            manejarDragOver(event) {
                event.preventDefault();
                event.stopPropagation();
            },

            manejarDragLeave(event) {
                event.preventDefault();
                event.stopPropagation();
            },
            //Aqui se agregan los archivos si los sueltas
            manejarDrop(event) {
                event.preventDefault();
                event.stopPropagation();

                this.archivos = event.dataTransfer.files;
                for (let i = 0; i < this.archivos.length; i++) {
                    const archivo = this.archivos[i];
                    this.documentos.push({ nombre: archivo.name, archivo: archivo });
                }
            },
            enviarDatos() {
            
                const formData = new FormData();
                formData.append('nombre', this.nombre);
                formData.append('primer_apellido', this.primerApellido);
                formData.append('segundo_apellido', this.segundoApellido);
                formData.append('calle', this.calle);
                formData.append('numero', this.numero);
                formData.append('colonia', this.colonia);
                formData.append('codigo_postal', this.codigoPostal);
                formData.append('telefono', this.telefono);
                formData.append('rfc', this.rfc);

                for (let i = 0; i < this.documentos.length; i++) {
                    const documento = this.documentos[i];
                    formData.append('archivos[]', documento.archivo);
                }

                axios.post('/prospectos-agregar', formData)
                    .then(response => {
                        console.log(response.data);
                        this.openModal();
                    })
                    .catch(error => {
                        this.errores = {};

                        // Recorremos los errores y guardamos solo los nombres de los campos con error
                        for (let campo in error.response.data.errors) {
                            this.errores[campo] = campo;
                        }
                        console.log(this.errores);
                    });
            
            }
        }
    };
</script>

<style scoped>
    .drop-area {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    float: right;
    }
    img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    }
    h7{
        color: rgb(255, 45, 45);
    }
    .archivos {
        float: right;
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